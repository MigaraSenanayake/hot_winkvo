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
                    
                    <!-- Dashboard Link -->
                    <a class="nav-link <?= ($current_page == 'fo_index.php') ? 'active' : '' ?>" href="fo_index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <br>

                    <!-- Guest Registration Collapsible Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['b_customer.php', 'w_customer.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseGuest">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Guest Registration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseGuest">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= ($current_page == 'b_customer.php') ? 'active' : '' ?>" href="b_customer.php">In-House Guest</a>
                            <a class="nav-link <?= ($current_page == 'w_customer.php') ? 'active' : '' ?>" href="w_customer.php">Walk-In Guest</a>
                        </nav>
                    </div>

                    <!-- Rooms Link -->
                    <a class="nav-link <?= ($current_page == 'rooms.php') ? 'active' : '' ?>" href="rooms.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Rooms
                    </a>

                    <!-- F & B List Link -->
                    <a class="nav-link <?= ($current_page == 'menu_items.php') ? 'active' : '' ?>" href="menu_items.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-cutlery"></i></div>
                        F & B List
                    </a>

                    <!-- Create Order Collapsible Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['create_order2.php', 'create_order.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Create Order
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseOrders">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= ($current_page == 'create_order2.php') ? 'active' : '' ?>" href="create_order2.php">In-House Guest</a>
                            <a class="nav-link <?= ($current_page == 'create_order.php') ? 'active' : '' ?>" href="create_order.php">Walk-In Guest</a>
                        </nav>
                    </div>

                    <!-- Create Invoice Collapsible Section -->
                    <a class="nav-link collapsed <?= (in_array($current_page, ['create_invoice2.php', 'create_invoice.php'])) ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseInvoice">
                        <div class="sb-nav-link-icon"><i class="fas fa-usd"></i></div>
                        Create Invoice
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseInvoice">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= ($current_page == 'create_invoice2.php') ? 'active' : '' ?>" href="create_invoice2.php">In-House Guest</a>
                            <a class="nav-link <?= ($current_page == 'create_invoice.php') ? 'active' : '' ?>" href="create_invoice.php">Walk-In Guest</a>
                        </nav>
                    </div>

                    <br><br><br>
                    <hr>

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