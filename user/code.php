<?php
include_once('../config/function.php');
require '../vendor/autoload.php'; // Ensure the path is correct
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['save_B_Cus'])) {

    if (!isset($_POST['terms'])) {
        redirect('front_office/b_cus_create.php', 'You must agree to the terms and conditions.');
        exit;
    } else {

        $requiredFields = [
            'title', 'fname', 'lname', 'arrival', 'departure', 'r_num', 'room_pack', 'room',
            'a_count', 'email', 'dob', 'booking'
        ];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                redirect('front_office/b_cus_create.php', 'Please Fill in All Required Fields.');
                exit;
            }
        }

        $email = validate($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect('front_office/b_cus_create.php', 'Invalid email format.');
            exit;
        }

       // File uploads
        $photo = $_FILES['photo'];
        $visa_photo = $_FILES['visa_photo'];
        $targetDir = "uploads/";

        $photoName = $_POST['existing_photo']; // Default to existing file
        if (!empty($photo['name'])) {
            $photoName = time() . "_" . basename($photo["name"]);
            $photoTarget = $targetDir . $photoName;
            if (move_uploaded_file($photo["tmp_name"], $photoTarget)) {
                unlink($targetDir . $_POST['existing_photo']); // Delete old file
            }
        }

        $visaPhotoName = $_POST['existing_visa_photo']; // Default to existing file
        if (!empty($visa_photo['name'])) {
            $visaPhotoName = time() . "_" . basename($visa_photo["name"]);
            $visaPhotoTarget = $targetDir . $visaPhotoName;
            if (move_uploaded_file($visa_photo["tmp_name"], $visaPhotoTarget)) {
                unlink($targetDir . $_POST['existing_visa_photo']); // Delete old file
            }
        }      

        // // Get the last inserted ID for confirmation or further processing
        // $lastInsertId = $pdo->lastInsertId();

        $address = $_POST['street'] . ', ' . $_POST['state_pc'] . ', ' . $_POST['city'];
        $phone = $_POST['c_code'] . $_POST['pNum'];  // Ensure international format

        // Prepare data for saving to the database
        $data = [
            'title' => validate($_POST['title']),
            'fname' => validate($_POST['fname']),
            'lname' => validate($_POST['lname']),
            'bname' => validate($_POST['bname']),
            'arrival' => validate($_POST['arrival']),
            'departure' => validate($_POST['departure']),
            'r_num' => validate($_POST['r_num']),
            'room_pack' => implode(',', $_POST['room_pack']),
            'room' => implode(',', $_POST['room']),
            'a_count' => validate($_POST['a_count']),
            'c_count_s' => validate($_POST['c_count_s']),
            'c_count_b' => validate($_POST['c_count_b']),
            'email' => $email,
            'phone' => $phone,
            'country_code' => validate($_POST['c_code']),
            'pNum' => validate($_POST['pNum']),
            'address_type' => validate($_POST['address_type']),
            'street' => validate($_POST['street']),
            'state_pc' => validate($_POST['state_pc']),
            'city' => validate($_POST['city']),
            'address' => $address,
            'dob' => validate($_POST['dob']),
            'nationality' => validate($_POST['nation']),
            'nic_pp' => validate($_POST['nic_pp']),
            'issue_date' => validate($_POST['issue_date']),
            'issue_place' => validate($_POST['issue_place']),
            'exp_date' => validate($_POST['exp_date']),
            'photo' => $photoName,
            'visa_photo' => $visaPhotoName,
            'booking' => validate($_POST['booking']),
            'advance' => validate($_POST['advance']),
            'special' => validate($_POST['special']),
        ];

        // Insert customer data
        $result = insert('bcustomers', $data);

        if ($result) { // Assuming `$result` confirms successful database insertion
            try {
                // PHPMailer configuration
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'subasethvilla@gmail.com';
                $mail->Password = 'dmbc bjlo nlic favs'; // Use App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('subasethvilla@gmail.com', 'Subaseth Villa');
                $mail->addAddress($email, $data['fname'] . ' ' . $data['lname']); // Recipient
                $mail->Subject = 'Welcome to Subaseth Villa';
                $mail->Body = "Dear {$data['title']} {$data['fname']} {$data['lname']}\n\n" .
                                "Ayubowan! (May you live long)\n\n" .
                                "Welcome to Subaseth Villa!\n\n" .
                                "We are delighted to inform your registration details.\n\n" .
                                "Registration Details:\n" .
                                "- Arrival Date: {$data['arrival']}\n" .
                                "- Departure Date: {$data['departure']}\n" .
                                "- Room Number(s): {$data['room']}\n\n" .
                                "Wifi Password:  Subasethvilla1\n\n" .
                                "Below is our F&B Menu\n " .
                                "https://subasethvilla.com/villa_Menu/restaurant_menu/\n\n" .
                                "Please place food orders at least 60 minutes before as we freshly prepare food at all times\n\n" .
                                "Food order example:\n" .
                                "A La Carte: No. 16/chicken QTY 01\n\n" .
                                "Feel free to contact us via +94777972548 for any assistance 24/7. We are always here to make your stay comfortable as possible\n\n" .
                                "Have a pleasant stay at Subaseth Villa\n\n" .                                
                                "Best Regards,\nSubaseth Villa Team \n\n" .
                                "System by WINKVO Software Solution. Tel. 076 947 1721";

                $mail->send();
                echo 'Email sent successfully!';
                redirect('front_office/b_customer.php', 'Email sent successfully!');
            } catch (Exception $e) {
                
                redirect('front_office/b_cus_create.php', 'Email failed to send');
            }
        } else {
            
            redirect('front_office/b_cus_create.php', 'Failed to Register User.');
        }
    }
}

if (isset($_POST['edit_b_cus'])) {
    $b_cus_Id = validate($_POST['b_cus_Id']);
    $userData = getById('bcustomers', $b_cus_Id);

    if ($userData['status'] != 200) {
        redirect('front_office/b_cus_edit.php?id=' . $b_cus_Id, 'Invalid User ID.');
        exit;
    }

    // Collect and validate inputs
    $title = validate($_POST['title']);
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $bname = validate($_POST['bname']);
    $arrival = validate($_POST['arrival']);
    $departure = validate($_POST['departure']);
    $r_num = validate($_POST['r_num']);
    $room_pack = implode(',', $_POST['room_pack']);    
    $room = implode(',', $_POST['room']);    
    $a_count = validate($_POST['a_count']);
    $c_count_s = validate($_POST['c_count_s']);
    $c_count_b = validate($_POST['c_count_b']);
    $email = validate($_POST['email']);    
    $c_code = validate($_POST['c_code']);
    $pNum = validate($_POST['pNum']);
    $address_type = validate($_POST['address_type']);
    $street = validate($_POST['street']);
    $state_pc = validate($_POST['state_pc']);
    $city = validate($_POST['city']);
    $dob = validate($_POST['dob']);
    $nation = validate($_POST['nation']);
    $nic_pp = validate($_POST['nic_pp']);
    $issue_date = validate($_POST['issue_date']);
    $issue_place = validate($_POST['issue_place']);
    $exp_date = validate($_POST['exp_date']);
    $booking = validate($_POST['booking']);
    $meal_plan = validate($_POST['meal_plan']);
    $advance = validate($_POST['advance']);
    $special = validate($_POST['special']);

    // Get current photos in case no new image is uploaded
    $currentNicPhoto = $userData['data']['photo'];
    $currentVisaPhoto = $userData['data']['visa_photo'];

    // Image upload logic
    $photo = $_FILES['photo'];
    $visa_photo = $_FILES['visa_photo'];

    // Define the target directory
    $targetDir = "uploads/";  // Ensure this folder exists and has write permissions

    // Handle NIC/Passport image if a new file is uploaded
    if (!empty($photo['name'])) {
        if ($photo['error'] !== UPLOAD_ERR_OK) {
            redirect('b_cus_edit.php', 'Error uploading NIC/Passport image: ' . $photo['error']);
            exit;
        }

        // Define new file name
        $photoName = time() . "_" . basename($photo["name"]);
        $photoTarget = $targetDir . $photoName;

        // Verify file type and move the file to the target directory
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($photo['type'], $allowedTypes) && move_uploaded_file($photo["tmp_name"], $photoTarget)) {
            // Delete the old photo if it exists
            if ($currentNicPhoto && file_exists($targetDir . $currentNicPhoto)) {
                unlink($targetDir . $currentNicPhoto);
            }
        } else {
            redirect('b_cus_edit.php', 'Invalid file type or upload failed for NIC/Passport image.');
            exit;
        }
    } else {
        $photoName = $currentNicPhoto;  // Keep the existing photo if no new file is uploaded
    }

    // Handle Visa image if a new file is uploaded
    if (!empty($visa_photo['name'])) {
        if ($visa_photo['error'] !== UPLOAD_ERR_OK) {
            redirect('b_cus_edit.php', 'Error uploading Visa image: ' . $visa_photo['error']);
            exit;
        }

        // Define new file name
        $visaPhotoName = time() . "_" . basename($visa_photo["name"]);
        $visaPhotoTarget = $targetDir . $visaPhotoName;

        // Verify file type and move the file to the target directory
        if (in_array($visa_photo['type'], $allowedTypes) && move_uploaded_file($visa_photo["tmp_name"], $visaPhotoTarget)) {
            // Delete the old visa photo if it exists
            if ($currentVisaPhoto && file_exists($targetDir . $currentVisaPhoto)) {
                unlink($targetDir . $currentVisaPhoto);
            }
        } else {
            redirect('b_cus_edit.php', 'Invalid file type or upload failed for Visa image.');
            exit;
        }
    } else {
        $visaPhotoName = $currentVisaPhoto;  // Keep the existing visa photo if no new file is uploaded
    }

    // Construct full address
    $address = $street . ', ' . $state_pc . ', ' . $city;

    $phone = $c_code.$pNum;

    // Email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('front_office/b_cus_edit.php?id=' . $b_cus_Id, 'Invalid email format.');
        exit;
    }

    // Update record if fields are not empty
    if (!empty($fname) && !empty($lname) && !empty($email)) {
        $data = [
            'title' => $title,
            'fname' => $fname,
            'lname' => $lname,
            'bname' => $bname,
            'arrival' => $arrival,
            'departure' => $departure,
            'r_num' => $r_num,            
            'room_pack' => $room_pack,           
            'room' => $room,           
            'a_count' => $a_count,
            'c_count_s' => $c_count_s,
            'c_count_b' => $c_count_b,
            'email' => $email,
            'phone' => $phone,
            'country_code' => $country_code,
            'pNum' => $pNum,
            'address_type' => $address_type,
            'address' => $address,
            'street' => $street,
            'state_pc' => $state_pc,
            'city' => $city,
            'dob' => $dob,
            'nationality' => $nation,
            'nic_pp' => $nic_pp,
            'issue_date' => $issue_date,
            'issue_place' => $issue_place,
            'exp_date' => $exp_date,
            'photo' => $photoName,
            'visa_photo' => $visaPhotoName,
            'booking' => $booking,
            'advance' => $advance,            
            'special' => $special,
        ];

        $result = update('bcustomers', $b_cus_Id, $data);

        if ($result) {
            redirect('front_office/b_customer.php', 'Customer Details Updated Successfully.');
        } else {
            redirect('front_office/b_cus_edit.php?id=' . $b_cus_Id, 'Something Went Wrong!');
        }
    } else {
        redirect('front_office/b_cus_edit.php?id=' . $b_cus_Id, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['change_meal'])) {

    $b_cus_Id = validate($_POST['b_cus_Id']);
    $userData = getById('bcustomers', $b_cus_Id);

    if ($userData['status'] != 200) {
        redirect('restaurant/b_cus_edit.php?id=' . $b_cus_Id, 'Invalid User ID.');
        exit;
    }


    $meal_plan = validate($_POST['meal_plan']);
    

    $data = ['meal_plan' => $meal_plan,];

    $result = update('bcustomers', $b_cus_Id, $data);

    if ($result) {
        redirect('restaurant/b_customer.php', 'Meal Plan Changed Successfully.');
    } else {
        redirect('restaurant/change_meal.php?id=' . $b_cus_Id, 'Something Went Wrong!');
    }
}  

if (isset($_POST['edit_w_cus'])) {
    $w_cus_Id = validate($_POST['w_cus_Id']);
    $w_cus_Data = getById('w_customers', $w_cus_Id);

    if ($w_cus_Data['status'] != 200) {
        redirect('front_office/w_cus_edit.php?id=' . $w_cus_Id, 'Invalid User ID.');
    }

    $title = validate($_POST['title']);
    $name = validate($_POST['name']);
    $bname = validate($_POST['bname']);
    $address = validate($_POST['address']);
    $nic_pp = validate($_POST['nic_pp']);
    $c_code = validate($_POST['c_code']);
    $pNum = validate($_POST['pNum']);    
    $email = validate($_POST['email']);
    

    $phone = $c_code.$pNum;
   
    // **Email format validation**
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('front_office/w_cus_edit.php?id=' . $w_cus_Id, 'Invalid email format.');
    }

        
    if (!empty($name) && !empty($email)) {
        $data = [
            'title' => $title,
            'name' => $name,
            'bname' => $bname,
            'address' => $address,
            'nic_pp' => $nic_pp,
            'c_code' => $c_code,
            'pNum' => $pNum,
            'phone' => $phone,
            'email' => $email,
                         
        ];
        $result = update('w_customers', $w_cus_Id, $data);

        if ($result) {
            redirect('front_office/w_customer.php', 'User Updated Successfully.');
        } else {
            redirect('front_office/w_cus_edit.php?id=' . $w_cus_Id, 'Something Went Wrong!');
        }
    } else {
        redirect('front_office/w_cus_edit.php?id=' . $w_cus_Id, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['save_w_cus'])) {
    // Collect and validate inputs
    $title = validate($_POST['title']);
    $name = validate($_POST['name']);
    $bname = validate($_POST['bname']);
    $address = validate($_POST['address']);
    $nic_pp = validate($_POST['nic_pp']);
    $c_code = validate($_POST['c_code']);
    $pNum = validate($_POST['pNum']);
    $email = validate($_POST['email']);
    

    $phone = $c_code.$pNum;
   

        // Check if all required fields are filled
        if (!empty($title) && !empty($name) && !empty($nic_pp)) 
        {
            // Email format validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                redirect('front_office/w_cus_create.php', 'Invalid email format.');
                exit;
            }

            // Prepare data for insertion
            $data = 
            [
                'title' => $title,
                'name' => $name,
                'bname' => $bname,
                'address' => $address,
                'nic_pp' => $nic_pp,
                'c_code' => $c_code,
                'pNum' => $pNum,
                'phone' => $phone,
                'email' => $email,    
                         
                
            ];

            $result = insert('w_customers', $data);

            if ($result) 
            {
                redirect('front_office/w_customer.php', 'Customer Registered Successfully.');
            }
            else 
            {
                redirect('front_office/w_cus_create.php', 'Something Went Wrong!');
            }
        } 
        else 
        {
            redirect('front_office/w_cus_create.php', 'Please Fill in All Required Fields.');
        }
    
}

// Close the database connection 
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();










