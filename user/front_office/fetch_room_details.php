<?php
require "../../config/function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];

    $response = [];

    // Fetch `room` and `room_pack` details for the given customer ID
    $customerQuery = $conn->prepare("SELECT room, room_pack FROM bcustomer WHERE id = ?");
    $customerQuery->bind_param("i", $customerId);
    $customerQuery->execute();
    $customerResult = $customerQuery->get_result()->fetch_assoc();

    if ($customerResult) {
        $response['room_numbers'] = explode(',', $customerResult['room']); // Room numbers
        $roomPackIds = explode(',', $customerResult['room_pack']); // Room pack IDs

        // Fetch room pack details
        $placeholders = implode(',', array_fill(0, count($roomPackIds), '?'));
        $packQuery = $conn->prepare("SELECT package_name, price, s_charge FROM room_cat WHERE id IN ($placeholders)");
        $packQuery->bind_param(str_repeat('i', count($roomPackIds)), ...$roomPackIds);
        $packQuery->execute();
        $packResult = $packQuery->get_result()->fetch_all(MYSQLI_ASSOC);

        $response['room_pack_details'] = $packResult;
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Customer not found.';
    }

    echo json_encode($response);
}
?>
