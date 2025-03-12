<?php 

require 'config/function.php';

session_start(); // Start the session

if (isset($_POST['forgotAdminPasswordBtn'])) {
    $email = validate($_POST['email']); // Sanitize the input email

    if ($email != '') {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Generate a unique token and expiration time (1 hour from now)
            $token = bin2hex(random_bytes(50));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
            
            // Store the token and expiry in the database
            $update_stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $update_stmt->bind_param("sss", $token, $expiry, $email);
            
            if ($update_stmt->execute()) {
                // Send reset link to the user's email
                $reset_link = "http://www.subasethvilla.com/reset_password.php?token=" . $token;

                $subject = "Password Reset Request";
                $message = "Hello,\n\nWe received a request to reset your password. Please click the link below to reset it:\n\n$reset_link\n\nIf you did not request a password reset, please ignore this email.\n\nBest regards,\nYour Website Team";
                $headers = "From: subasethvilla@gmail.com";

                if (mail($email, $subject, $message, $headers)) {
                    $_SESSION['message'] = "Password reset link has been sent to your email.";
                    redirect("login.php", "Password reset link sent to your email.");
                } else {
                    redirect("forgot_admin_password.php", "Failed to send the email. Please try again.");
                }
            } else {
                redirect("forgot_admin_password.php", "Something went wrong. Please try again.");
            }
            $update_stmt->close();
        } else {
            redirect("forgot_admin_password.php", "No account found with this email.");
        }
        $stmt->close();
    } else {
        redirect("forgot_admin_password.php", "Email is required!");
    }
} else {
    redirect("forgot_admin_password.php", "Unauthorized Access!");
}

if (isset($_POST['forgotUserPasswordBtn'])) {
    $email = validate($_POST['email']); // Sanitize the input email

    if ($email != '') {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Generate a unique token and expiration time (1 hour from now)
            $token = bin2hex(random_bytes(50));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
            
            // Store the token and expiry in the database
            $update_stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $update_stmt->bind_param("sss", $token, $expiry, $email);
            
            if ($update_stmt->execute()) {
                // Send reset link to the user's email
                $reset_link = "http://www.subasethvilla.com/reset_password.php?token=" . $token;

                $subject = "Password Reset Request";
                $message = "Hello,\n\nWe received a request to reset your password. Please click the link below to reset it:\n\n$reset_link\n\nIf you did not request a password reset, please ignore this email.\n\nBest regards,\nYour Website Team";
                $headers = "From: subasethvilla@gmail.com";

                if (mail($email, $subject, $message, $headers)) {
                    $_SESSION['message'] = "Password reset link has been sent to your email.";
                    redirect("login.php", "Password reset link sent to your email.");
                } else {
                    redirect("forgot_user_password.php", "Failed to send the email. Please try again.");
                }
            } else {
                redirect("forgot_user_password.php", "Something went wrong. Please try again.");
            }
            $update_stmt->close();
        } else {
            redirect("forgot_user_password.php", "No account found with this email.");
        }
        $stmt->close();
    } else {
        redirect("forgot_user_password.php", "Email is required!");
    }
} else {
    redirect("forgot_user_password.php", "Unauthorized Access!");
}


?>
