<?php
require "../../config/function.php";

if (isset($_GET['id'])) {
    $packId = intval($_GET['id']);
    
    // Prepare and execute query to prevent SQL injection
    $stmt = $conn->prepare("SELECT package_name, price, s_charge FROM room_cat WHERE id = ?");
    $stmt->bind_param("i", $packId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $item = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'package_name' => $item['package_name'],            
            's_charge' => $item['s_charge'],
            'price' => $item['price']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
