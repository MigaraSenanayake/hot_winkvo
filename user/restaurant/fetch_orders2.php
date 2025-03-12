<?php
require "../../config/function.php";

if (isset($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
    $customerId = intval($_POST['customer_id']); // Sanitize input

    $query = "
        SELECT o.id AS order_id, 
               o.order_date, 
               o.status, 
               o.total_price AS order_total, 
               oi.item_id, 
               m.name AS description, 
               oi.quantity, 
               oi.unit_price, 
               oi.total_price AS item_total
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN menu m ON m.id = oi.item_id
        WHERE o.customer_id = ? AND o.status != 'paid'
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $customerId);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        echo json_encode($orders);
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid customer ID']);
}
?>
