<?php require 'include/header1.php'; ?>

<div style="
    background: url('pic/hotel3.jpg') no-repeat center center/cover;
    height: 100vh; 
    width: 100%; 
    display: flex; 
    flex-direction: column;  /* Align items in a column */
    align-items: center; 
    justify-content: center;
    text-align: center; /* Ensures text is centered */
">

    <?php alertMessage(); ?>

    <img src="pic/suba.png" alt="Hotel Logo" width="340" height="220" >
    
    <h1 style="color: white; font-size: 70px;">Welcome</h1>
    <br>
    <h2 style="color: white; font-size: 31px;">Hotel Management System V. 2024</h2>

    <br>

    <?php if(isset($_SESSION['loggedIn'])) : ?>
        <p style="color: white; font-size: 20px;">Hello, <?= $_SESSION['loggedInUser']['name']; ?> 👋 please logout before login again</p>

        <a href="logout.php" style="
            display: inline-block; 
            background: rgba(255, 0, 0, 0.3);
            padding: 10px 20px; 
            border-radius: 10px;
            color: white; 
            font-size: 18px; 
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: background 0.3s ease;
        " onmouseover="this.style.background='rgba(255,0,0,0.7)'" 
          onmouseout="this.style.background='rgba(255,0,0,0.3)'">
            Logout
        </a>
    
    <?php else: ?>
        <div style="margin-top: 20px; display: flex; gap: 20px;">
            <a href="login.php" style="
                display: inline-block; 
                background: rgba(0, 80, 255, 0.3);
                padding: 10px 20px; 
                border-radius: 10px;
                color: white; 
                font-size: 18px; 
                text-decoration: none;
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: background 0.3s ease;
            " onmouseover="this.style.background='rgba(0,80,255,0.7)'" 
              onmouseout="this.style.background='rgba(0,80,255,0.3)'">
                Admin Login
            </a>

            <a href="ulogin.php" style="
                display: inline-block; 
                background: rgba(0, 80, 255, 0.3);
                padding: 10px 20px; 
                border-radius: 10px;
                color: white; 
                font-size: 18px; 
                text-decoration: none;
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: background 0.3s ease;
            " onmouseover="this.style.background='rgba(0,80,255,0.7)'" 
              onmouseout="this.style.background='rgba(0,80,255,0.3)'">
                User Login
            </a>
        </div>
    <?php endif; ?>

    <br>

    <div>
        <img src="pic/glow.png" width="470" height="70" alt="Glow Effect">
    </div>
</div>

<?php include('include/footer1.php'); ?>
