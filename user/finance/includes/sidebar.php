<!DOCTYPE html>
<?php
// Get current page and convert to lowercase
$current_page = strtolower(basename($_SERVER['PHP_SELF']));
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sb-sidenav .nav-link.active {
            background-color: #9092943B;
            color: white !important;
           
        }
        .sb-sidenav .nav-link:hover {
            background-color: #90929417;
            color: white !important;
           
        }
        
    </style>
</head>
<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <br><br><br>
                    
                    <!-- Dashboard Link -->
                    <a class="nav-link <?= ($current_page == 'f_index.php') ? 'active' : '' ?>" href="f_index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    
                    <br><br><br>

                    <!-- In-House Payments Link -->
                    <a class="nav-link <?= ($current_page == 'payments.php') ? 'active' : '' ?>" href="payments.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                        In-House Payments
                    </a> 

                    <!-- Walk-In Payments Link -->
                    <a class="nav-link <?= ($current_page == 'w_payments.php') ? 'active' : '' ?>" href="w_payments.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Walk-In Payments
                    </a> 

                    <br><br><br><hr>

                    <!-- Logout Link -->
                    <div class="logout">
                        <a class="nav-link" href="../../logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                            Logout
                        </a>
                    </div>  
                </div>
            </div>
            <div class="sb-sidenav-footer">                        
                <center>
                    <img src="../../pic/win logo 2.png" width="130" height="63">
                </center>                    
            </div>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>