<?php
include("../../config/function.php");

// Retrieve 'index' directly from the $_GET array
$paramResult = isset($_GET['index']) ? $_GET['index'] : null;

// Debugging: Output the parameter for inspection
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

// Check if session variables are set and index exists in the arrays
if (isset($_SESSION['order_items'][$indexValue]) && isset($_SESSION['order_itemIds'][$indexValue])) {

    // Unset the specific item from both session arrays
    unset($_SESSION['order_items'][$indexValue]);
    unset($_SESSION['order_itemIds'][$indexValue]);

    // Reindex arrays to maintain order after deletion
    $_SESSION['order_items'] = array_values($_SESSION['order_items']);
    $_SESSION['order_itemIds'] = array_values($_SESSION['order_itemIds']);

    // Redirect with success message
    redirect('create_order.php', 'Item Removed');
} else {
    // If the item at the index does not exist
    redirect('create_order.php', 'Item not found or already removed');
}
