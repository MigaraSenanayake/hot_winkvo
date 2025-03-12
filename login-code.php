<?php 

require 'config/function.php';

session_start(); // Start the session

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']); // Corrected to use $_POST
    $password = validate($_POST['password']); // Corrected to use $_POST

    if ($email != '' && $password != '') {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            if (!password_verify($password, $hashedPassword)) { // Corrected condition
                redirect('login.php', 'Invalid Password');
            } else {
                // Set session variables for logged-in user
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_Id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                redirect('admin/index.php', 'Welcome WINKVO HMS Adimnistrator');
            }
        } else {
            redirect('login.php', 'Invalid Email Address');
        }
        $stmt->close();
    } else {
        redirect('login.php', 'All Fields are Mandatory!');
    }
} else {
    redirect('login.php', 'Unauthorized Access!');
}
?>
