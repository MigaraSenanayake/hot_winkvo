<?php
require '../../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

        redirect("create_order.php", $row['name'] . ' added to Cart');
    } else {
        redirect("create_order.php", "Item Not Found!");
    }
}

// Submit the order
if (isset($_POST['submitOrder'])) {
     if (isset($_POST['cusId']) && isset($_SESSION['order_items']) && !empty($_SESSION['order_items'])) {
        $cusId = intval($_POST['cusId']);
        $totalPrice = 0;

        // Calculate total price
        foreach ($_SESSION['order_items'] as $item) {
            $totalPrice += $item['price'] * $item['qty'];
        }

        // Insert order into `w_` table
        $stmt = $conn->prepare("INSERT INTO w_orders (customer_id, total_price) VALUES (?, ?)");
        $stmt->bind_param("id", $cusId, $totalPrice);

        if ($stmt->execute()) {
            $orderId = $conn->insert_id;

            // Insert each item into `order_items` table
            foreach ($_SESSION['order_items'] as $item) {
                $totalItemPrice = $item['price'] * $item['qty'];
                $stmtItem = $conn->prepare(
                    "INSERT INTO w_order_items (order_id, item_id, quantity, unit_price, total_price) VALUES (?, ?, ?, ?, ?)"
                );
                $stmtItem->bind_param("iiidd", $orderId, $item['item_id'], $item['qty'], $item['price'], $totalItemPrice);

                if (!$stmtItem->execute()) {
                    echo "Error adding item: " . $stmtItem->error . "<br>";
                    exit();
                }
            }

            // KOT Preview (HTML)
            echo "<h1>Subaseth villa KOT</h1>";
            echo "<p>Order ID: $orderId</p>";
            echo "<ul>";
            foreach ($_SESSION['order_items'] as $item) {
                echo "<li>{$item['name']} x {$item['qty']}</li>";
            }
            echo "</ul>";
            echo "<button onclick='window.print()'>Print KOT</button>";

            // KOT Print (Thermal Printer)
            try {
                $connector = new WindowsPrintConnector("Your_Printer_Name");
                $printer = new Printer($connector);

                $printer->text("Subaseth villa KOT\n");
                $printer->text("Order ID: $orderId\n");
                foreach ($_SESSION['order_items'] as $item) {
                    $printer->text("{$item['name']} x {$item['qty']}\n");
                }
                $printer->cut();
                $printer->close();
            } catch (Exception $e) {
                echo "Error printing KOT: " . $e->getMessage();
            }

            // Clear session data
            unset($_SESSION['order_items'], $_SESSION['order_itemIds']);
        } else {
            redirect('create_order.php', 'Error while saving the order.');
        }
    } else {        
        if (!isset($_POST['cusId']) || empty($_POST['cusId'])) {
            
            redirect("create_order.php", "Customer not selected. Please select a customer.");
            
        } elseif (empty($_SESSION['order_items'])) {
            
            redirect("create_order.php", "No items in the cart. Please add items to the cart.");

        } elseif (empty($_SESSION['order_items'])) {
        
        }    
    }
}
?>