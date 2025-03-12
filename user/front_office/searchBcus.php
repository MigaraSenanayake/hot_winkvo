<?php
require '../../config/function.php';

if (isset($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
    $customerId = intval($_POST['customer_id']); // Sanitize input

    $query = "
        SELECT id, title, fname, lname, bname, email, room_pack, room, advance, arrival, departure, booking
        FROM bcustomers
        WHERE id = ?
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();

        if ($customer) {
            $arrival = $customer['arrival'];
            $departure = $customer['departure'];

            // Debugging: Log arrival and departure
            error_log("Arrival: " . $arrival);
            error_log("Departure: " . $departure);

            // Check if arrival and departure dates are valid
            if (!empty($arrival) && !empty($departure)) {
                try {
                    // Convert to DateTime objects
                    $arrivalDate = new DateTime($arrival);
                    $departureDate = new DateTime($departure);

                    // Calculate the difference
                    $interval = $arrivalDate->diff($departureDate);

                    // Get the number of days
                    $days = $interval->days;

                    // Debugging: Log days
                    error_log("Days calculated: " . $days);
                } catch (Exception $e) {
                    $days = 0; // Default to 0 in case of an error
                    error_log("Date calculation error: " . $e->getMessage());
                }
            } else {
                $days = 0; // Default to 0 if dates are empty
                error_log("Invalid dates: Arrival or departure is empty.");
            }

            echo json_encode([
                'success' => true,
                'id' => $customer['id'],
                'name' => $customer['title'] . ' ' . $customer['fname'] . ' ' . $customer['lname'],
                'bname' => $customer['bname'],
                'email' => $customer['email'],
                'room' => $customer['room'],
                'room_pack' => $customer['room_pack'],
                'advance' => $customer['advance'],    
                'booking' => $customer['booking'],           
                'days' => $days, // Include days in the response
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
