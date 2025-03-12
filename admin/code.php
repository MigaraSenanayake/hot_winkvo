<?php

include('../config/function.php');

if (isset($_POST['saveAdmin'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $cpassword = validate($_POST['conf_password']);

    // Check if all required fields are filled
    if (!empty($name) && !empty($email) && !empty($password) && !empty($phone) && !empty($cpassword)) {

        // **Email format validation**
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect('admins-create.php', 'Invalid email format.');
        }

        // **Password validation: at least 6 characters, one uppercase, one lowercase, one special character, and one number**
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
            redirect('admins-create.php', 'Password must be at least 6 characters long and include one uppercase letter, one lowercase letter, one special character, and one number.');
        }

        // Ensure password and confirm password match
        if ($password !== $cpassword) {
            redirect('admins-create.php', 'Passwords do not match.');
        }

        // Prepare SQL statement to check if email is already used
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        if (!$stmt) {
            redirect('admins-create.php', 'Database error. Please try again later.');
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $emailCheck = $stmt->get_result();

        if ($emailCheck && $emailCheck->num_rows > 0) {
            redirect('admins-create.php', 'Email already used by another room_cat_');
        }

        // Hash the password securely
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
        ];

        $result = insert('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin Added Successfully.');
        } else {
            redirect('admins-create.php', 'Something Went Wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['updateAdmin'])) {
    $adminId = validate($_POST['adminId']);
    $adminData = getById('admins', $adminId);

    if ($adminData['status'] != 200) {
        redirect('admins-edit.php?id=' . $adminId, 'Invalid Admin ID.');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $cpassword = validate($_POST['conf_password']);
    $phone = validate($_POST['phone']);
    

    // **Email format validation**
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('admins-edit.php?id=' . $adminId, 'Invalid email format.');
    }

    // **Password validation: at least 6 characters, one uppercase, one lowercase, one special character, and one number**
    if (!empty($password) && !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
        redirect('admins-edit.php?id=' . $adminId, 'Password must be at least 6 characters long and include one uppercase letter, one lowercase letter, one special character, and one number.');
    }

    // Ensure password and confirm password match
    if (!empty($password) && $password !== $cpassword) {
        redirect('admins-edit.php?id=' . $adminId, 'Passwords Do Not Match.');
    }

    // Determine if the password needs to be hashed
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : $adminData['data']['password'];

    if (!empty($name) && !empty($email)) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
        ];
        $result = update('admins', $adminId, $data);

        if ($result) {
            redirect('admins.php', 'Admin Updated Successfully.');
        } else {
            redirect('admins-edit.php?id=' . $adminId, 'Something Went Wrong!');
        }
    } else {
        redirect('admins-edit.php?id=' . $adminId, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $cpassword = validate($_POST['conf_password']);
    $usection= validate($_POST['user_section']);

    // Check if all required fields are filled
    if (!empty($name) && !empty($email) && !empty($password) && !empty($phone) && !empty($cpassword) && !empty($usection)) {

        // **Email format validation**
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect('user-create.php', 'Invalid email format.');
        }

        // **Password validation: at least 6 characters, one uppercase, one lowercase, one special character, and one number**
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
            redirect('user-create.php', 'Password must be at least 6 characters long and include one uppercase letter, one lowercase letter, one special character, and one number.');
        }

        // Ensure password and confirm password match
        if ($password !== $cpassword) {
            redirect('user-create.php', 'Passwords do not match.');
        }

        // Prepare SQL statement to check if email is already used
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            redirect('user-create.php', 'Database error. Please try again later.');
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $emailCheck = $stmt->get_result();

        if ($emailCheck && $emailCheck->num_rows > 0) {
            redirect('user-create.php', 'Email already used by another user.');
        }

        // Hash the password securely
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'user_section' => $usection,
        ];

        $result = insert('users', $data);
        if ($result) {
            redirect('users.php', 'User Added Successfully.');
        } else {
            redirect('user-create.php', 'Something Went Wrong!');
        }
    } else {
        redirect('user-create.php', 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['updateUser'])) {
    $userId = validate($_POST['userId']);
    $userData = getById('users', $userId);

    if ($userData['status'] != 200) {
        redirect('user-edit.php?id=' . $userId, 'Invalid User ID.');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $cpassword = validate($_POST['conf_password']);
    $phone = validate($_POST['phone']);
    $usection= validate($_POST['user_section']);

    // **Email format validation**
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('user-edit.php?id=' . $userId, 'Invalid email format.');
    }

    // **Password validation: at least 6 characters, one uppercase, one lowercase, one special character, and one number**
    if (!empty($password) && !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
        redirect('user-edit.php?id=' . $userId, 'Password must be at least 6 characters long and include one uppercase letter, one lowercase letter, one special character, and one number.');
    }

    // Ensure password and confirm password match
    if (!empty($password) && $password !== $cpassword) {
        redirect('user-edit.php?id=' . $userId, 'Passwords Do Not Match.');
    }

    // Determine if the password needs to be hashed
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : $adminData['data']['password'];

    if (!empty($name) && !empty($email)) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'user_section' => $usection,

        ];
        $result = update('users', $userId, $data);

        if ($result) {
            redirect('users.php', 'User Updated Successfully.');
        } else {
            redirect('user-edit.php?id=' . $userId, 'Something Went Wrong!');
        }
    } else {
        redirect('user-edit.php?id=' . $userId, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['save_menu'])) {
    $menu_cat = validate($_POST['menu_cat']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
           
    // Prepare SQL statement to check if name is already used
    $stmt = $conn->prepare("SELECT * FROM menu WHERE name = ?");
    if (!$stmt) {
        redirect('menu_create.php', 'Database Error Try Again Shortly.');
    }

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $nameCheck = $stmt->get_result();
    
    
    $data = [        
        'menu_cat' => $menu_cat,
        'name' => $name,
        'price' => $price,        
    ];

    $result = insert('menu', $data);
    if ($result) {
        redirect('menu_items.php', 'Menu Item Added Successfully.');
    } else {
        redirect('menu_create.php', 'Something Went Wrong!');
    }
    
}

if (isset($_POST['update_menu'])) {
    $menuId = validate($_POST['menuId']);
    $menuData = getById('menu', $menuId);

    if ($menuData['status'] != 200) {
        redirect('menu_edit.php?id=' . $menu, 'Invalid Menu Item ID.');
    }

    
    $menu_cat = validate($_POST['menu_cat']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
         

   
    if (!empty($name) && !empty($price)) {
        $data = [
            
            'menu_cat' => $menu_cat,
            'name' => $name,
            'price' => $price,  
            
        ];
        $result = update('menu', $menuId, $data);

        if ($result) {
            redirect('menu_items.php', 'Menu Item Updated Successfully.');
        } else {
            redirect('menu_edit.php?id=' . $menuId, 'Something Went Wrong!');
        }
    } else {
        redirect('menu_edit.php?id=' . $menuId, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['save_room_cat'])) {
    // Collect and validate inputs
  
    $cat = validate($_POST['cat']);
    $cat_code = validate($_POST['cat_code']);
    $type = validate($_POST['type']);
    $r_num = validate($_POST['r_num']);
    $meal_plan = validate($_POST['meal_plan']);
    $price = validate($_POST['price']);
    $s_charge = validate($_POST['s_charge']);

    $package_name = $cat.' '.$type.' '.$meal_plan;
    

        // Check if all required fields are filled
        if (!empty($cat) && !empty($price) && !empty($s_charge) && !empty($s_charge) && !empty($meal_plan)) 
        {
           $r_total = $price + $s_charge;

            // Prepare data for insertion
            $data = 
            [                
                'cat' => $cat,
                'cat_code' => $cat_code,
                'type' => $type,
                'r_num' => $r_num,  
                'meal_plan' => $meal_plan,  
                'price' => $price,
                's_charge' => $s_charge, 
                'r_total' => $r_total,
                'package_name' => $package_name   
            ];

            $result = insert('room_cat', $data);

            if ($result) 
            {
                redirect('rooms.php', 'Package Registered Successfully.');
            }
            else 
            {
                redirect('room_create.php', 'Something Went Wrong!');
            }
        } 
        else 
        {
            redirect('room_create.php', 'Please Fill in All Required Fields.');
        }
    
}

if (isset($_POST['update_room_cat'])) {
    $package_Id = validate($_POST['package_Id']);
    $package_Data = getById('room_cat', $package_Id);

    if ($package_Data['status'] != 200) {
        redirect('room_edit.php?id=' . $package_Id, 'Invalid Package ID.');
    }

    
    $cat = validate($_POST['cat']);
    $cat_code = validate($_POST['cat_code']);
    $type = validate($_POST['type']);
    $r_num = validate($_POST['r_num']);
    $meal_plan = validate($_POST['meal_plan']);
    $price = validate($_POST['price']);
    $s_charge = validate($_POST['s_charge']);

    $package_name = $cat.' '.$type.' '.$meal_plan;
   
    $r_total = $price + $s_charge;     

    if (!empty($package_Id)) {
        $data = [
            
            'cat' => $cat,
            'cat_code' => $cat_code,
            'type' => $type,
            'r_num' => $r_num,  
            'meal_plan' => $meal_plan,  
            'price' => $price,
            's_charge' => $s_charge,    
            'r_total' => $r_total,
            'package_name' => $package_name            
        ];
        $result = update('room_cat', $package_Id, $data);

        if ($result) {
            redirect('rooms.php', 'Package Updated Successfully.');
        } else {
            redirect('room_edit.php?id=' . $package_Id, 'Something Went Wrong!');
        }
    } else {
        redirect('room_edit.php?id=' . $package_Id, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['save_room'])) {
    // Collect and validate inputs
  
    $room_cat = validate($_POST['room_cat']);
    $room_name = validate($_POST['room_name']);
    $room_no = validate($_POST['room_no']);
    

        // Check if all required fields are filled
        if (!empty($room_cat) && !empty($room_name) && !empty($room_no)) 
        {
           

            // Prepare data for insertion
            $data = 
            [
                'room_cat' => $room_cat,
                'room_name' => $room_name,
                'room_no' => $room_no  
            ];

            $result = insert('room', $data);

            if ($result) 
            {
                redirect('room_num.php', 'Room Registered Successfully.');
            }
            else 
            {
                redirect('room_num_create.php', 'Something Went Wrong!');
            }
        } 
        else 
        {
            redirect('room_num_create.php', 'Please Fill in All Required Fields.');
        }
    
}

if (isset($_POST['update_room'])) {
    $room_Id = validate($_POST['room_Id']);
    $room_Data = getById('room', $room_Id);

    if ($room_Data['status'] != 200) {
        redirect('room_num_edit.php?id=' . $room_Id, 'Invalid Package ID.');
    }
    
    $room_cat = validate($_POST['room_cat']);    
    $room_name = validate($_POST['room_name']);
    $room_no = validate($_POST['room_no']);   

    if (!empty($room_Id)) {
        $data = [
            
            'room_cat' => $room_cat,
            'room_name' => $room_name,
            'room_no' => $room_no                       
        ];
        $result = update('room', $room_Id, $data);

        if ($result) {
            redirect('room_num.php', 'Package Updated Successfully.');
        } else {
            redirect('room_num_edit.php?id=' . $room_Id, 'Something Went Wrong!');
        }
    } else {
        redirect('room_num_edit.php?id=' . $room_Id, 'Please Fill in All Required Fields.');
    }
}

if (isset($_POST['updatePayment'])) {
    $payment_Id = validate($_POST['paymentId']);
    $payment_Data = getById('payments', $payment_Id);

    if ($payment_Data['status'] != 200) {
        redirect('payments-edit.php?id=' . $payment_Id, 'Invalid Payment ID.');
    }
    
    $payment_date = validate($_POST['payment_date']);    
    $bill_total = validate($_POST['bill_total']);
     

    if (!empty($payment_Id)) {
        $data = [
            
            'payment_date' => $payment_date,
            'bill_total' => $bill_total,
                                   
        ];
        $result = update('payments', $payment_Id, $data);

        if ($result) {
            redirect('verify_b_payments.php', 'Payment Updated Successfully.');
        } else {
            redirect('payments-edit.php?id=' . $payment_Id, 'Something Went Wrong!');
        }
    } else {
        redirect('payments-edit.php?id=' . $payment_Id, 'Please Fill in All Required Fields.');
    }
}



// Close the database connection 
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>
