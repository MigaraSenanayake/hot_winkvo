<?php
include("../../config/function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
    $orderIds = isset($_POST['order_ids']) ? $_POST['order_ids'] : ''; // Comma-separated
    $billTotalWithService = isset($_POST['bill_total']) ? floatval($_POST['bill_total']) : 0; // Renamed
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $cashPay = isset($_POST['cash_given']) ? floatval($_POST['cash_given']) : 0;
    $cardPay = isset($_POST['card_payment']) ? floatval($_POST['card_payment']) : 0;
    $cardNumber = isset($_POST['card_number']) ? trim($_POST['card_number']) : null;
    $serviceCharge = isset($_POST['total_service_charge']) ? floatval($_POST['total_service_charge']) : 0;
    $booking = isset($_POST['booking']) ? $_POST['booking'] : '';

    // Validate inputs
    if ($paymentMethod === 'card' && empty($cardNumber)) {
        echo json_encode(['status' => 'error', 'message' => 'Last four numbers are required for card payments.']);
        exit();
    }

    if ($billTotalWithService <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid bill total.']);
        exit();
    }

    // Subtract service charge from bill total
    $billTotal = $billTotalWithService - $serviceCharge; // Renamed

    // Prepare and execute the SQL statement
    $stmtPayment = $conn->prepare("
        INSERT INTO payments (
            customer_id, 
            order_ids, 
            bill_total, 
            payment_method, 
            cashPay, 
            cardPay, 
            card_number,            
            service_charge,
            booking
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmtPayment->bind_param(
        'isssddsss',
        $customerId,
        $orderIds,
        $billTotal, // Use the adjusted bill total
        $paymentMethod,
        $cashPay,
        $cardPay,
        $cardNumber,
        $serviceCharge,
        $booking
    );

    if ($stmtPayment->execute()) {
        $paymentId = $conn->insert_id;
        echo json_encode([
            'status' => 'success',
            'message' => 'Payment details saved successfully!',
            'payment_id' => $paymentId,
        ]);
    } else {
        error_log("Payment Insert Error: " . $stmtPayment->error);
        echo json_encode([
            'status' => 'error',
            'message' => 'Error while saving payment details. Please try again.',
        ]);
    }

    $stmtPayment->close();
}
?>