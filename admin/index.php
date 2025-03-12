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

function getTotal_bcust($conn) {
    $sql = "SELECT COUNT(*) AS total_bcust 
            FROM bcustomers 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
            AND YEAR(created_at) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_bcust'];
    } else {
        return 0;
    }
}
$total_bcust = getTotal_bcust($conn);

function getTotal_wcust($conn) {
    $sql = "SELECT COUNT(*) AS total_wcust 
            FROM w_customers 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
            AND YEAR(created_at) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_wcust'];
    } else {
        return 0;
    }
}
$total_wcust = getTotal_wcust($conn);
function getTotal_b_income($conn) {
    $sql = "SELECT SUM(bill_total) AS total_b_income 
            FROM payments 
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_b_income'] ?? 0;
    } else {
        return 0;
    }
}

function getTotal_w_income($conn) {
    $sql = "SELECT SUM(bill_total) AS total_w_income 
            FROM w_payments 
            WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_w_income'] ?? 0;
    } else {
        return 0;
    }
}

$total_b_income = getTotal_b_income($conn);
$total_w_income = getTotal_w_income($conn);

$total_income = $total_b_income + $total_w_income; // Total income for current month
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
    <h1 class="mt-3">ADMIN Dashboard (Current Month)</h1>
    <ol class="breadcrumb mb-2"></ol>

    <?php alertMessage(); ?>
    
    <br>
    <div class="row">

        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: #8785E9FF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="70" height="70" onerror="this.style.display='none'; document.getElementById('fallbackIcon1').style.display='block';">
                    <i id="fallbackIcon1" class="fas fa-bed" style="display: none; color: #413FC7FF;  font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>In-House Guest</h5>            
                    <center><h3><?php echo $total_bcust; ?></h></center>
                </div>           
            </div>
        </div>


        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: #64D881FF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="70" height="70" onerror="this.style.display='none'; document.getElementById('fallbackIcon3').style.display='block';">
                    <i id="fallbackIcon3" class="fas fa-users" style="display: none; color: #11B33AFF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Walk-In Guest</h5>
                    <center><h3><?php echo $total_wcust; ?></h3></center>
                </div>           
            </div>
        </div>


        <div class="col-xl-4 col-md-4">
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


        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: #E46464FF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon4').style.display='block';">
                    <i id="fallbackIcon4" class="fas fa-usd" style="display: none; color:  #C02222FF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Total Income</h5>            
                    <center><h3><?php echo 'Rs.'.' '.$total_income_formatted; ?></h3></center>
                    
                </div>           
            </div>
        </div> 

        
        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: #CB70FFFF; position: relative;">
                <div style="position: absolute; top: 8px; right: 8px;">
                    <img src="path/to/user.png"  width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon5').style.display='block';">
                    <i id="fallbackIcon5" class="fas fa-signing" style="display: none; color: #A45ACFFF; font-size: 80px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Total S. Charge</h5>            
                    <center><h3><?php echo 'Rs.'.' '.$total_service_formatted; ?></h3></center>
                    
                </div>           
            </div>
        </div> 

        <?php
// Fetch monthly income data
function getMonthlyIncome($conn) {
    $sql = "
        SELECT 
            MONTH(payment_date) AS month,
            SUM(bill_total) AS total_income
        FROM payments
        WHERE YEAR(payment_date) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(payment_date)

        UNION ALL

        SELECT 
            MONTH(payment_date) AS month,
            SUM(bill_total) AS total_income
        FROM w_payments
        WHERE YEAR(payment_date) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(payment_date)
    ";

    $result = $conn->query($sql);

    $monthlyIncome = array_fill(1, 12, 0); // Initialize an array for all 12 months with 0 income

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $month = $row['month'];
            $income = $row['total_income'];
            $monthlyIncome[$month] += $income; // Sum income for each month
        }
    }

    return $monthlyIncome;
}

$monthlyIncome = getMonthlyIncome($conn);

// Prepare data for the chart
$months = [
    'January', 'February', 'March', 'April', 'May', 'June', 
    'July', 'August', 'September', 'October', 'November', 'December'
];

$incomeData = [];
foreach ($months as $index => $month) {
    $incomeData[] = $monthlyIncome[$index + 1]; // Add income for each month
}
?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Add the chart canvas -->
<div class="container-fluid px-4">
    <!-- Existing cards and other content -->

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Income (Current Year)</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyIncomeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Render the chart -->
<script>
    const ctx = document.getElementById('monthlyIncomeChart').getContext('2d');
    const monthlyIncomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Monthly Income',
                data: <?php echo json_encode($incomeData); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Income (Rs)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
</script>    
        
   
</div>

<?php include('includes/footer.php') ?>