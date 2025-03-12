<?php
require "../../config/function.php";

if (isset($_GET['id'])) {
    $itemId = intval($_GET['id']);
    
    // Prepare and execute query to prevent SQL injection
    $stmt = $conn->prepare("SELECT name, price FROM menu WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $item = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'name' => $item['name'],
            'price' => $item['price']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

