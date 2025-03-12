<?php
session_start();

if (isset($_SESSION['order_items']) || isset($_SESSION['order_itemIds'])) {
    unset($_SESSION['order_items'], $_SESSION['order_itemIds']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Cart is already empty.']);
}
?>
