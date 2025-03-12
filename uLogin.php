<?php 
include('include/header1.php');

if(isset($_SESSION['loggedIn']))
{
    ?>
        <script>window.location.href = 'index.php'</script>
    <?php
}

?>

 
<div style="
    background: url('pic/hotel3.jpg') no-repeat center center/cover;
    height: 100vh; 
    width: 100%; 
    display: flex; 
    align-items: center; 
    justify-content: center;
">


    <!-- Back button -->
    <div style="position: absolute; top: 20px; left: 20px; z-index: 100;">
        <a href="index.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;"
        onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
            <img src="pic/user.png" width="70" height="70"
                onerror="this.style.display='none'; document.getElementById('fallbackIcon1').style.display='inline-block';">
            <i id="fallbackIcon1" class="fa fa-mail-reply" 
            style="display: none; color: white; font-size: 50px;"></i>
        </a>
    </div>

    <div style="
        width: 45%; 
        background: rgba(255, 255, 255, 0.2); 
        backdrop-filter: blur(20px); 
        border: 1px solid rgba(255, 255, 255, 0.3); 
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); 
        padding: 40px; 
        border-radius: 20px;
    ">

        <?php alertMessage_1(); ?>
        
        <div style="text-align: center;">
            
            <h1 style="color: white; font-size: 45px;">USER LOGIN</h1>
        </div>

        
        <form action="ulogin-code.php" method="POST">

        
            <div style="margin-bottom: 15px;">
                <label style="color: white; font-size: 18px;">Email</label>
                <input type="text" name="email" style="width: 100%; padding: 10px; font-size: 18px; border-radius: 10px; align-content:center; border: 1px solid #ccc;" required />
            </div>

            <div style="margin-bottom: 15px;">
                <label style="color: white; font-size: 18px;">Password</label>
                <input type="password" name="password" style="width: 100%; padding: 10px; font-size: 18px; align-content:center; border-radius: 10px; border: 1px solid #ccc;" required />
            </div>

            <br>

            <div style="text-align: center; margin-bottom: 20px;">
                <button type="submit" name="uLoginBtn" style="
                    width: 100%; 
                    padding: 10px; 
                    background: rgba(255, 255, 255, 0.3); 
                    border: 1px solid rgba(255, 255, 255, 0.5); 
                    color: white; 
                    font-size: 18 px;
                    border-radius: 10px; 
                    cursor: pointer;
                " onmouseover="this.style.background='rgba(0,80,255,0.7)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    Login
                </button>
            </div>

            <div style="text-align: center;">
                <img src="pic/glow.png" width="470" height="70">
            </div>

        </form>
    </div>
</div>

<?php include('include/footer1.php'); ?>