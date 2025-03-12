<?php
require "../../config/function.php";

header('Content-Type: application/json'); // Ensure JSON output

if (isset($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']); // Sanitize input

    $query = "SELECT id, name, bname FROM w_customers WHERE id = $customer_id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'id' => $customer['id'],
            'name' => $customer['name'],
            'bname' => $customer['bname']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Customer not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
