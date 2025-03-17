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
        .sb-sidenav .nav-link.collapsed.active {
            background-color: #9092943B;
            color: white !important;
        }
    </style>
</head>
<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <br>
                    
                    <!-- Dashboard -->
                    <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <br>

                    <!-- Staff Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['admins.php', 'users.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                        Staff
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAdmins">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= ($current_page == 'admins.php') ? 'active' : '' ?>" href="admins.php">Admins</a>
                            <a class="nav-link <?= ($current_page == 'users.php') ? 'active' : '' ?>" href="users.php">Users</a>
                        </nav>
                    </div>

                    <!-- Verify Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['verify_b_order_payments.php', 'verify_w_order_payments.php', 'verify_b_payments.php', 'verify_w_payments.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseVerify">
                        <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                        Verify
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseVerify">
                        <nav class="sb-sidenav-menu-nested nav accordion">
                            <a class="nav-link collapsed <?= (in_array($current_page, ['verify_b_order_payments.php', 'verify_w_order_payments.php'])) ? 'active' : '' ?>" 
                               href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth">
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($current_page == 'verify_b_order_payments.php') ? 'active' : '' ?>" href="verify_b_order_payments.php">In-House</a>
                                    <a class="nav-link <?= ($current_page == 'verify_w_order_payments.php') ? 'active' : '' ?>" href="verify_w_order_payments.php">Walk-In</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed <?= (in_array($current_page, ['verify_b_payments.php', 'verify_w_payments.php'])) ? 'active' : '' ?>" 
                               href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsePayments">
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapsePayments">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($current_page == 'verify_b_payments.php') ? 'active' : '' ?>" href="verify_b_payments.php">In-House</a>
                                    <a class="nav-link <?= ($current_page == 'verify_w_payments.php') ? 'active' : '' ?>" href="verify_w_payments.php">Walk-In</a>
                                </nav>
                            </div>
                        </nav>
                    </div>

                    <!-- F & B -->
                    <a class="nav-link <?= ($current_page == 'menu_items.php') ? 'active' : '' ?>" href="menu_items.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-cutlery"></i></div>
                        F & B
                    </a>

                    <!-- Rooms & Packages -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['room_num.php', 'rooms.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseRooms">
                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Rooms & Packages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRooms">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= ($current_page == 'room_num.php') ? 'active' : '' ?>" href="room_num.php">Rooms</a>
                            <a class="nav-link <?= ($current_page == 'rooms.php') ? 'active' : '' ?>" href="rooms.php">Packages</a>
                        </nav>
                    </div>

                    <!-- Reports Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['payments.php', 'w_payments.php', 'orders_items.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports">
                        <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseReports">
                        <nav class="sb-sidenav-menu-nested nav accordion">
                            <a class="nav-link collapsed <?= (in_array($current_page, ['payments.php', 'w_payments.php'])) ? 'active' : '' ?>" 
                               href="#" data-bs-toggle="collapse" data-bs-target="#CollapsePayments">
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="CollapsePayments">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($current_page == 'payments.php') ? 'active' : '' ?>" href="payments.php">In-House</a>
                                    <a class="nav-link <?= ($current_page == 'w_payments.php') ? 'active' : '' ?>" href="w_payments.php">Walk-In</a>
                                </nav>
                            </div>
                            <a class="nav-link <?= ($current_page == 'orders_items.php') ? 'active' : '' ?>" href="orders_items.php">Sold Items</a>
                        </nav>
                    </div>

                    <br><hr>

                    <!-- Logout -->
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
                    <img src="../pic/win logo 2.png" width="130" height="63">
                </center>
            </div>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>