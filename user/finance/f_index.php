<?php 

$total_income_formatted = 0;
$total_wcust = 0;
$total_bcust = 0;
$total_Orders = 0;




include('includes/header.php'); 


function getTotal_b_Orders($conn){
    $sql = "SELECT COUNT(*) AS total_b_Orders
            FROM orders
            WHERE MONTH(order_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(order_date) = YEAR(CURRENT_DATE())";
    $result = $conn ->query($sql);

    if($result){
        $row = $result->fetch_assoc();
        return $row['total_b_Orders'];
    } else {
        error_log("Database query faild: ". $conn->error);
        return 0;
    }

}

$total_b_Orders = getTotal_b_Orders($conn);


function getTotal_W_Orders($conn){
    $sql = "SELECT COUNT(*) AS total_w_Orders 
            FROM w_orders
            WHERE MONTH(order_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(order_date) = YEAR(CURRENT_DATE())";
    $result = $conn ->query($sql);

    if($result){
        $row = $result->fetch_assoc();
        return $row['total_w_Orders'];
    } else {
        error_log("Database query faild: ". $conn->error);
        return 0;
    }

}

$total_w_Orders = getTotal_W_Orders($conn);

$total_Orders = $total_b_Orders + $total_w_Orders;// total walk-in & in-house guest orders




function getTotal_b_income($conn) {
    $sql = "SELECT SUM(bill_total) AS total_b_income 
            FROM payments
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_b_income'];
    } else {
        return 0;
    }
}
$total_b_income = getTotal_b_income($conn);

function getTotal_w_income($conn) {
    $sql = "SELECT SUM(bill_total) AS total_w_income 
            FROM w_payments
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_w_income'];
    } else {
        return 0;
    }
}
$total_w_income = getTotal_w_income($conn);

$total_income = $total_b_income + $total_w_income; //total income
$total_income_formatted = number_format($total_income, 2);

function getTotal_b_service($conn) {
    $sql = "SELECT SUM(service_charge) AS total_b_service 
            FROM payments
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_b_service'];
    } else {
        return 0;
    }
}
$total_b_service = getTotal_b_service($conn);

function getTotal_w_service($conn) {
    $sql = "SELECT SUM(service_charge) AS total_w_service 
            FROM w_payments
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_w_service'];
    } else {
        return 0;
    }
}
$total_w_service = getTotal_w_service($conn);

$total_service = $total_b_service + $total_w_service; //total income
$total_service_formatted = number_format($total_service, 2);


?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Finance Dashboard (Current Month)</h1>
    <ol class="breadcrumb mb-3"></ol>

    <?php alertMessage(); ?>
     
    <div class="row">

        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4" style="background-color: #8AD9E7FF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon2').style.display='block';">
                    <i id="fallbackIcon2" class="fas fa-shopping-cart" style="display: none; color: #21B5CFFF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Orders</h5>            
                    <center><h3><?php echo $total_Orders; ?></h3></center>
                    
                </div>           
            </div>
        </div>


        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4" style="background-color: #E46464FF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon4').style.display='block';">
                    <i id="fallbackIcon4" class="fas fa-usd" style="display: none; color: #C02222FF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Total Income</h5>            
                    <center><h3><?php echo 'Rs.'.' '.$total_income_formatted; ?></h3></center>
                    
                </div>           
            </div>
        </div> 

        
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4" style="background-color: #CB70FFFF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon5').style.display='block';">
                    <i id="fallbackIcon5" class="fas fa-coins" style="display: none; color: #A45ACFFF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Total S. Charge</h5>            
                    <center><h3><?php echo 'Rs.'.' '.$total_service_formatted; ?></h3></center>
                    
                </div>           
            </div>
        </div>    
</div>

<?php include('includes/footer.php') ?>