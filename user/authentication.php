<?php 

if(isset($_SESSION['loggedIn']))
{
    $email = validate($_SESSION['loggedInUser']['email']);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0)
    {
        logoutSession();
        redirect('../../uLogin.php','Access Denied!');
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
    }
}

else
{
    redirect('../../uLogin.php','Login to Continue...');
}

?>