<?php
require '../../config/function.php';

if (isset($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
    $customerId = intval($_POST['customer_id']); // Sanitize input

    $query = "
        SELECT id, title, fname, lname, bname
        FROM bcustomers
        WHERE id = ?
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();

        if ($customer) {
            echo json_encode([
                'success' => true,
                'id' => $customer['id'],
                'name' => $customer['title'] . ' ' . $customer['fname'] . ' ' . $customer['lname'],
                'bname' => $customer['bname'],
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Customer not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database query failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid customer ID']);
}
?>
