<?php



// Include your custom function file
include("../../config/function.php");

// Initialize session variables
if (!isset($_SESSION['order_items'])) $_SESSION['order_items'] = [];
if (!isset($_SESSION['order_itemIds'])) $_SESSION['order_itemIds'] = [];

// Add item to cart
if (isset($_POST['addItem'])) {
    $itemId = validate($_POST['searchId']);
    $qty = validate($_POST['qty']);

    $checkItem = mysqli_query($conn, "SELECT * FROM menu WHERE id = '$itemId' LIMIT 1");
    if ($checkItem && mysqli_num_rows($checkItem) > 0) {
        $row = mysqli_fetch_assoc($checkItem);

        $itemData = [
            'item_id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'qty' => $qty,
        ];

        $itemExists = false;
        foreach ($_SESSION['order_items'] as $key => $existingItem) {
            if ($existingItem['item_id'] === $row['id']) {
                $_SESSION['order_items'][$key]['qty'] += $qty;
                $itemExists = true;
                break;
            }
        }

        if (!$itemExists) {
            $_SESSION['order_items'][] = $itemData;
            $_SESSION['order_itemIds'][] = $row['id'];
        }

        redirect("create_order2.php", $row['name'] . ' added to Cart');
    } else {
        redirect("create_order2.php", "Item Not Found!");
    }
}

if (isset($_POST['addC_Item'])) {
    $citemName = validate($_POST['citemName']);
    $cQty = validate($_POST['cQty']);
    $cItemPrice = validate($_POST['cItemPrice']);

    // Validate custom item fields
    if (!empty($citemName) && is_numeric($cQty) && $cQty > 0) {
        $itemData = [
            'item_id' => null, // No database ID for custom items
            'name' => $citemName,
            'price' => $cItemPrice,
            'qty' => $cQty,
        ];

        $_SESSION['order_items'][] = $itemData;

        redirect("create_order2.php", $citemName . ' added to Cart');
    } else {
        redirect("create_order2.php", "Invalid custom item details. Please check your input.");
    }
}

/// Submit the order
if (isset($_POST['submitOrder'])) {
    if (
        isset($_POST['cusId']) && !empty($_POST['cusId']) &&
        isset($_SESSION['order_items']) && !empty($_SESSION['order_items']) &&
        isset($_POST['location']) && !empty($_POST['location']) &&
        isset($_POST['readyTime']) && !empty($_POST['readyTime'])
    ) {
        date_default_timezone_set('Asia/Colombo'); // Set Sri Lanka timezone
        
        $cusId = intval($_POST['cusId']);
        $totalPrice = 0;
        $createdBy = $_SESSION['loggedInUser']['name'];
        $currentTime24 = date('Y-m-d H:i:s'); // Order creation time
        $currentTime = date("Y-m-d h:i A", strtotime($currentTime24));
        $serveLocation = validate($_POST['location']); // Serve location
        $tableOrRoom = isset($_POST['tableOrRoom']) ? validate($_POST['tableOrRoom']) : null; // Optional
        $readyTime24 = validate($_POST['readyTime']); // Ready by time
        $remarks = validate($_POST['remarks']); // Special remarks

        $readyTime = date("Y-m-d h:i A", strtotime($readyTime24));

        // Calculate total price
        foreach ($_SESSION['order_items'] as $item) {
            $totalPrice += $item['price'] * $item['qty'];
        }

        // Insert the order into `orders` table
        $stmt = $conn->prepare(
            "INSERT INTO orders (customer_id, total_price, created_by, created_at, serve_location, table_or_room, ready_time, remarks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("idssssss", $cusId, $totalPrice, $createdBy, $currentTime, $serveLocation, $tableOrRoom, $readyTime, $remarks);

        if ($stmt->execute()) {
            $orderId = $conn->insert_id;

            // Insert items into `order_items` table
            foreach ($_SESSION['order_items'] as $item) {
                $totalItemPrice = $item['price'] * $item['qty'];

                if (isset($item['item_id']) && !empty($item['item_id'])) {
                    $stmtItem = $conn->prepare(
                        "INSERT INTO order_items (order_id, item_id, quantity, unit_price, total_price) 
                        VALUES (?, ?, ?, ?, ?)"
                    );
                    $stmtItem->bind_param("iiidd", $orderId, $item['item_id'], $item['qty'], $item['price'], $totalItemPrice);
                } else {
                    $stmtItem = $conn->prepare(
                        "INSERT INTO order_items (order_id, item_id, name, quantity, unit_price, total_price) 
                        VALUES (?, NULL, ?, ?, ?, ?)"
                    );
                    $stmtItem->bind_param("isidd", $orderId, $item['name'], $item['qty'], $item['price'], $totalItemPrice);
                }

                if (!$stmtItem->execute()) {
                    redirect("create_order2.php", "Error adding item: " . $stmtItem->error);
                    exit();
                }
            }

            // Generate the KOT data to print
            $kotData = "";
            $kotData .= "Kitchen Order Ticket\n";
            $kotData .= "----------------------------\n";
            $kotData .= "Order ID: $orderId\n";
            $kotData .= "Created By: {$createdBy}\n";
            $kotData .= "Order Time: {$currentTime}\n";
            $kotData .= "Serve Location: {$serveLocation}\n";
            if (!empty($tableOrRoom)) {
                $kotData .= "Table/Room: {$tableOrRoom}\n";
            }
            $kotData .= "Ready By: " . ($readyTime ?? "N/A") . "\n";
            $kotData .= "Special Remarks: " . ($remarks ?? "None") . "\n";
            $kotData .= "----------------------------\n";

            // Loop through cart items and print their details
            foreach ($_SESSION['order_items'] as $item) {
                $itemName = htmlspecialchars($item['name']);
                $itemQty = intval($item['qty']);
                $kotData .= "$itemName x $itemQty\n";
            }

            $kotData .= "\nThank you!\n";

            // Save the content to a temporary file for printing
            $file = tempnam(sys_get_temp_dir(), "print");
            file_put_contents($file, $kotData);
            

        // Your existing code to print the KOT content

            // Add the cutting command after printing the KOT data
            $cutCommand = "\x1D\x56\x41\x00";  // Full cut command

            // Save the content to a temporary file for printing, append the cut command
            $file = tempnam(sys_get_temp_dir(), "print");
            file_put_contents($file, $kotData . $cutCommand); // Append the cut command to the KOT data

            // Send the print job using shell_exec
            $printerName = "POS_CV2";  // Change this to your actual printer name
            shell_exec("print /D:\"\\\\127.0.0.1\\$printerName\" " . escapeshellarg($file));

            // Remove the temporary file after printing
            unlink($file);

            // Clear the cart after successful submission and printing
            unset($_SESSION['order_items']);
            unset($_SESSION['order_itemIds']);

            // Redirect back to the order page after printing
            redirect("create_order2.php", "Order submitted and KOT printed!");




        } else {
            redirect("create_order2.php", "Error while saving the order: " . $stmt->error);
        }
    } else {
        // Improved error handling
        $errorMessage = "Error: ";
        if (!isset($_POST['cusId']) || empty($_POST['cusId'])) {
            $errorMessage .= "Customer not selected. ";
        }
        if (empty($_SESSION['order_items'])) {
            $errorMessage .= "No items in the cart. ";
        }
        if (!isset($_POST['location']) || empty($_POST['location'])) {
            $errorMessage .= "Serve location not provided. ";
        }
        if (!isset($_POST['readyTime']) || empty($_POST['readyTime'])) {
            $errorMessage .= "Ready By time not provided. ";
        }
        redirect("create_order2.php", trim($errorMessage));
    }
}
?>
