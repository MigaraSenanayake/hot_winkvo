<?php
include("../../config/function.php");

// Retrieve 'index' directly from the $_GET array
$paramResult = isset($_GET['index']) ? $_GET['index'] : null;

// Debugging: Output the parameter for inspection (optional, can be removed in production)
echo "Parameter Result (Direct): " . htmlspecialchars($paramResult);

// Check if parameter is missing or non-numeric
if ($paramResult === null) {
    redirect('create_order.php', 'Parameter is missing');
    exit();
} elseif (!is_numeric($paramResult)) {
    redirect('create_order.php', 'Parameter is not numeric');
    exit();
}

// Proceed if the parameter is numeric
$indexValue = (int)$paramResult; // Cast to integer for safety

// Check if session variables are set and the index exists in 'order_items'
if (isset($_SESSION['order_items'][$indexValue])) {
    $orderItem = $_SESSION['order_items'][$indexValue];
    $isCustomItem = !isset($orderItem['item_id']) || is_null($orderItem['item_id']); // Check if it's a custom item

    if ($isCustomItem) {
        // Remove the custom item
        unset($_SESSION['order_items'][$indexValue]);

        // Reindex the 'order_items' array to maintain order after deletion
        $_SESSION['order_items'] = array_values($_SESSION['order_items']);

        // Redirect with success message
        redirect('create_order.php', 'Custom item removed successfully');
    } else {
        // Remove the standard item (has a valid 'item_id')
        unset($_SESSION['order_items'][$indexValue]);
        unset($_SESSION['order_itemIds'][$indexValue]);

        // Reindex both arrays to maintain order after deletion
        $_SESSION['order_items'] = array_values($_SESSION['order_items']);
        $_SESSION['order_itemIds'] = array_values($_SESSION['order_itemIds']);

        // Redirect with success message
        redirect('create_order.php', 'Standard item removed successfully');
    }
} else {
    // If the item at the index does not exist
    redirect('create_order.php', 'Item not found or already removed');
}
