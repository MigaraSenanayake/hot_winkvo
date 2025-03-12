<?php
include('../config/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if order_ids exist and are an array
    if (isset($_POST['order_ids']) && is_array($_POST['order_ids'])) {
        // Sanitize the input
        $order_ids = array_map('intval', $_POST['order_ids']);

        if (!empty($order_ids)) {
            // Convert array to a comma-separated string for SQL query
            $order_ids_str = implode(',', $order_ids);

            // Prepare the update query
            $query = "UPDATE `orders` SET `status` = 'paid' WHERE `id` IN ($order_ids_str)";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Success: redirect with a success message
                redirect('verify_b_order_payments.php', 'Order statuses updated successfully.');
            } else {
                // Log error and redirect with failure message
                error_log(mysqli_error($conn));
                redirect('verify_b_order_payments.php', 'Failed to update order statuses.');
            }
        } else {
            // Redirect with no orders selected message
            redirect('verify_b_order_payments.php', 'No orders selected.');
        }
    } else {
        // Redirect with no orders selected message
        redirect('verify_b_order_payments.php', 'No orders selected.');
    }
}
?>
