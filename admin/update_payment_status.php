<?php
include('../config/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if payment_ids exist and are an array
    if (isset($_POST['payment_ids']) && is_array($_POST['payment_ids'])) {
        // Sanitize the input
        $payment_ids = array_map('intval', $_POST['payment_ids']);

        if (!empty($payment_ids)) {
            // Convert array to a comma-separated string for SQL query
            $payment_ids_str = implode(',', $payment_ids);

            // Prepare the update query
            $query = "UPDATE `payments` SET `status` = 'Success' WHERE `id` IN ($payment_ids_str)";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Success: redirect with a success message
                redirect('verify_b_payments.php', 'Payment statuses updated successfully.');
            } else {
                // Log error and redirect with failure message
                error_log(mysqli_error($conn));
                redirect('verify_b_payments.php', 'Failed to update payment statuses.');
            }
        } else {
            // Redirect with no payments selected message
            redirect('verify_b_payments.php', 'Payments not selected.');
        }
    } else {
        // Redirect with no payments selected message
        redirect('verify_b_payments.php', 'Payments not selected.');
    }
}
?>
