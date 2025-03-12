<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <!--  CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--  Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <br>
                    <a class="nav-link" href="fo_index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <br>
                    
                    <a class="nav-link collapsed" href="#"
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseGuest" 
                        aria-expanded="false" aria-controls="collapseGuest">

                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Guest Registration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseGuest" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">                            
                            <a class="nav-link" href="b_customer.php">In-House Guest</a>
                            <a class="nav-link" href="w_customer.php">Walk-In Guest</a>
                        </nav>
                    </div>  
                    
                    <a class="nav-link" href="rooms.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Rooms
                    </a>

                    <a class="nav-link" href="menu_items.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-cutlery"></i></div>
                        F & B List
                    </a> 

                    <a class="nav-link collapsed" href="#"
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseOrders" 
                        aria-expanded="false" aria-controls="collapseOrders">

                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Create Order
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseOrders" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">                            
                            <a class="nav-link" href="create_order2.php">In-House Guest</a>
                            <a class="nav-link" href="create_order.php">Walk-In Guest</a>
                        </nav>
                    </div>    


                    <a class="nav-link collapsed" href="#"
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseInvoice" 
                        aria-expanded="false" aria-controls="collapseInvoice">

                        <div class="sb-nav-link-icon"><i class="fas fa-usd"></i></div>
                        Create Invoice
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseInvoice" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">                            
                            <a class="nav-link" href="create_invoice2.php">In-House Guest</a>
                            <a class="nav-link" href="create_invoice.php">Walk-In Guest</a>
                        </nav>
                    </div>  
                                     

                    <br><br><br>
                    <hr>

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
                    <img src="../../pic/win logo 2.png" width="130" height="63" >                    
                </center>                    
            </div>
        </nav>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
