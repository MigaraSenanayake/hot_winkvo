<?php
// Include necessary files and functions
include("../../config/function.php");



// Handle POST request for payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect posted data
    $customerId = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
    $orderIds = isset($_POST['order_ids']) ? $_POST['order_ids'] : '';
    $billTotal = isset($_POST['bill_total']) ? floatval($_POST['bill_total']) : 0;
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $cardNumber = isset($_POST['card_number']) ? $_POST['card_number'] : '';
    $expDate = isset($_POST['exp_date']) ? $_POST['exp_date'] : '';
    $crc = isset($_POST['crc']) ? $_POST['crc'] : '';


    // Validate payment method and necessary fields
    if ($paymentMethod === 'card' && empty($cardNumber)) {
        echo json_encode(['status' => 'error', 'message' => 'Card details are missing']);
        exit();
    }

 

    // If the bill total is less than or equal to 0, we reject the payment
    if ($billTotal <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid bill total']);
        exit();
    }

    // Insert payment details into the database
    $stmtPayment = $conn->prepare("INSERT INTO payments (customer_id, order_ids, bill_total, payment_method, card_number, exp_date, crc) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtPayment->bind_param("issssss", $customerId, $orderIds, $billTotal, $paymentMethod, $cardNumber, $expDate, $crc);

    if ($stmtPayment->execute()) {
        $paymentId = $conn->insert_id;        
            
            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'Payment details saved successfully!',  'payment_id' => $paymentId]);        
        
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error while saving payment details: ' . $stmtPayment->error]);
    }
    $stmtPayment->close();
}

?>
