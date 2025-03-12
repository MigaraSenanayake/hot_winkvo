<?php
require "../../config/function.php";

if (isset($_POST['customer_id'])) {
    $customerId = $_POST['customer_id'];
   
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
        FROM w_orders o
        JOIN w_order_items oi ON o.id = oi.order_id
        JOIN menu m ON m.id = oi.item_id
        WHERE o.customer_id = ? AND o.status != 'paid'
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $customerId); // 'i' indicates integer type
    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result(); // Get the result from the executed query

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row; // Add each row as an array to $orders
    }

    // Return the orders as JSON to the front-end
    echo json_encode($orders);
}
