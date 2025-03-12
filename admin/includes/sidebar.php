<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                <br>
                
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>  
                    <br>      
                    
                    
                    <a class="nav-link collapsed" href="#"
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseAdmins" 
                        aria-expanded="false" aria-controls="collapseAdmins">

                        <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                        Staff
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAdmins" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">                            
                            <a class="nav-link" href="admins.php">Admins</a>
                            <a class="nav-link" href="users.php">Users</a>
                        </nav>
                    </div>

                                       
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVerify" aria-expanded="false" aria-controls="collapseVerify">
                        <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                        Verify
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseVerify" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionVerify">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionVerify">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="verify_b_order_payments.php">In-House</a>
                                    <a class="nav-link" href="verify_w_order_payments.php">Walk-In</a>                                    
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsePayments" aria-expanded="false" aria-controls="pagesCollapsePayments">
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapsePayments" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionVerify">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="verify_b_payments.php">In-House</a>
                                    <a class="nav-link" href="verify_w_payments.php">Walk-In</a>                                    
                                </nav>
                            </div>
                        </nav>
                    </div>



                    <a class="nav-link" href="menu_items.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-cutlery"></i></div>
                        F & B
                    </a>   
                    
                    


                    <!-- <a class="nav-link" href="setting_printers.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                        Printer Setting
                    </a>   -->

                    <a class="nav-link collapsed" href="#"
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseRooms" 
                        aria-expanded="false" aria-controls="collapseRooms">

                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Rooms &amp; Packages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRooms" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">                            
                            <a class="nav-link" href="room_num.php">Rooms</a>
                            <a class="nav-link" href="rooms.php">Room Packages</a>
                        </nav>
                    </div>    
                    
                    

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                        <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseReports" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="reportPay">                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#CollapsePayments" aria-expanded="false" aria-controls="CollapsePayments">
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="CollapsePayments" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionVerify">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="payments.php">In-House</a>
                                    <a class="nav-link" href="w_payments.php">Walk-In</a>                                    
                                </nav>
                            </div>
                                <a class="nav-link" href="orders_items.php">Selled Items</a>  
                        </nav>
                    </div>


                    
                    
                    

                    <br><br><br><hr>

                    <div class="logout">
                        <a class="nav-link" href="../logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                            Logout
                        </a>
                    </div> 


                  
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <center>
                    <img src="../pic/win logo 2.png" width="130" height="63" >                    
                </center>                    
            </div>
        </nav>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
