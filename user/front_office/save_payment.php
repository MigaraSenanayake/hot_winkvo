<?php
// Include necessary files and functions
include("../../config/function.php");

// Handle POST request for payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect posted data
    $customerId = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
    $orderIds = isset($_POST['order_ids']) ? $_POST['order_ids'] : ''; // Comma-separated string of order IDs
    $billTotalWithService = isset($_POST['bill_total']) ? floatval($_POST['bill_total']) : 0; // Renamed
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $cashPay = isset($_POST['cash_given']) ? intval($_POST['cash_given']) : 0; // Match cashPay type to decimal(10,0)
    $cardPay = isset($_POST['card_payment']) ? intval($_POST['card_payment']) : 0; // Match cardPay type to decimal(10,0)
    $cardNumber = isset($_POST['card_number']) ? trim($_POST['card_number']) : null; // Card number
    $serviceCharge = isset($_POST['total_service_charge']) ? floatval($_POST['total_service_charge']) : 0; // Service charge

    // Validate input
    if ($paymentMethod === 'card' && (empty($cardNumber))) {
        echo json_encode(['status' => 'error', 'message' => 'Last four numbers are required for card payments.']);
        exit();
    }

    if ($billTotal <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid bill total.']);
        exit();
    }

     // Subtract service charge from bill total
     $billTotal = $billTotalWithService - $serviceCharge; // Renamed

    // Insert payment details into the database
    $stmtPayment = $conn->prepare("
        INSERT INTO w_payments (
            customer_id, 
            order_ids, 
            bill_total, 
            payment_method, 
            cashPay, 
            cardPay, 
            card_number,             
            service_charge
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmtPayment->bind_param(
        'isdsddss',
        $customerId,
        $orderIds,
        $billTotal,
        $paymentMethod,
        $cashPay,
        $cardPay,
        $cardNumber,
        $serviceCharge
    );

    if ($stmtPayment->execute()) {
        $paymentId = $conn->insert_id; // Get the inserted payment ID
        echo json_encode([
            'status' => 'success',
            'message' => 'Payment details saved successfully!',
            'payment_id' => $paymentId,
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error while saving payment details: ' . $stmtPayment->error,
        ]);
    }

    $stmtPayment->close();
}
?>
