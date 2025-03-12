<?php 
include('include/header1.php'); 
?>

<div class="py-5 bg-light">
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow rounded-4">
                    <div class="p-5">
                        <center>
                            <img src="pic/logo.png" width="140" height="85">                            
                            <h3 class="text-dark mb-3">Forgot User Password</h3>
                            <p class="text-muted">Enter your email address below, and we’ll send you a link to reset your password.</p>
                        </center>
                        <br>

                        <form action="forgot_password_code.php" method="POST">
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" required />
                            </div>

                            <div class="my-3">
                                <button type="submit" name="forgotUserPasswordBtn" class="btn btn-outline-success w-100 mt-2">
                                    Send Reset Link
                                </button>
                            </div>
                        </form>
                       
                        <div class="text-center mt-3">
                            <a href="login.php" class="text-decoration-none">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer1.php'); ?>
