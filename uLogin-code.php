<?php 

require 'config/function.php';

session_start(); // Start the session

if (isset($_POST['uLoginBtn'])) {
    $email = validate($_POST['email']); // Corrected to use $_POST
    $password = validate($_POST['password']); // Corrected to use $_POST

    if ($email != '' && $password != '') {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            if (!password_verify($password, $hashedPassword)) { // Corrected condition
                redirect('uLogin.php', 'Invalid Password');
            } 
            if($row['user_section'] == "Front Office")
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_Id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'user_section'=> $row['user_section'],
                ];

                redirect('user/front_office/fo_index.php', 'Welcome to the Front Office Section');
            }

            else if($row['user_section'] == "Restaurant")
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_Id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'user_section'=> $row['user_section'],
                ];

                redirect('user/restaurant/r_index.php', 'Welcome to the Restaurant Section');   
            }

            else if($row['user_section'] == "Finance")
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_Id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'user_section'=> $row['user_section'],
                ];

                redirect('user/finance/f_index.php', 'Welcome to the Finance Section');   
            }
            
            else {
                // Set session variables for logged-in user
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_Id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'user_section'=> $row['user_section'],
                ];


                redirect('user/kitchen/k_index.php', 'Welcome to the Kitchen Store Section');
            }
        } else {
            redirect('uLogin.php', 'Invalid Email Address');
        }
        $stmt->close();
    } else {
        redirect('uLogin.php', 'All Fields are Mandatory!');
    }
} else {
    redirect('uLogin.php', 'Unauthorized Access!');
}
?>
