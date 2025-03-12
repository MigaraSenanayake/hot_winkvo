<?php 

include('includes/header.php'); 

function getTotal_B_Customers($conn) {
    $sql = "SELECT COUNT(*) AS total_b_customers FROM bcustomers";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_b_customers'];
    } else {
        error_log("Database query failed: " . $conn->error);
        return 0;
    }
}

// Example usage
$total_b_Customers = getTotal_B_Customers($conn);

// Function to get the total number of walk-in customers
function getTotal_W_Customers($conn) {
    $sql = "SELECT COUNT(*) AS total_w_customers FROM w_customers";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_w_customers'];
    } else {
        error_log("Database query failed: " . $conn->error);
        return 0;
    }
}

// Example usage
$total_w_Customers = getTotal_W_Customers($conn);

function getTotal_b_Orders($conn){
    $sql = "SELECT COUNT(*) AS total_b_Orders FROM orders";
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
    $sql = "SELECT COUNT(*) AS total_w_Orders FROM w_orders";
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

?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Restaurant Dashboard</h1>
    <ol class="breadcrumb mb-3"></ol>
     
    <?php alertMessage(); ?>
        
    <div class="row">
        <!-- In-House Guests Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #31DFD1FF; position: relative;">
                <div style="position: absolute; top: 30px; right: 10px;">
                    <img src="path/to/inhouseGuest.png" alt="In-House Guest Icon" width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon1').style.display='block';">
                    <i id="fallbackIcon1" class="fas fa-bed" style="display: none; color: white; font-size: 40px;"></i>
                </div>        
                <div class="card-body">
                    <h5>In-House Guests</h5>            
                    <center><h4><?php echo $total_b_Customers; ?></h4></center>
                    
                </div>           
            </div>
        </div>

        <!-- Walking Guests Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #30C0E4FF; position: relative;">
                <div style="position: absolute; top: 30px; right: 10px;">
                    <img src="path/to/walkingGuest.png" alt="Walk-in Guest Icon" width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon2').style.display='block';">
                    <i id="fallbackIcon2" class="fas fa-users" style="display: none; color: white; font-size: 40px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Walk-In Guests</h5>            
                    <center><h4><?php echo $total_w_Customers; ?></h4></center>
                
                </div>           
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #308DE4FF; position: relative;">
                <div style="position: absolute; top: 30px; right: 10px;">
                    <img src="path/to/walkingGuest.png" alt="Walk-in Guest Icon" width="80" height="80" onerror="this.style.display='none'; document.getElementById('fallbackIcon3').style.display='block';">
                    <i id="fallbackIcon3" class="fas fa-shopping-cart" style="display: none; color: white; font-size: 40px;"></i>
                </div>        
                <div class="card-body">
                    <h5>Orders</h5>            
                    <center><h4><?php echo $total_Orders?></h4></center>
                    
                </div>           
            </div>
        </div>
    </div>

    
</div>

<style>
    .table-container {
        display: flex;
        justify-content: center;
    }

    .table {
        text-align: center; /* Center text in table cells */
        margin: 0 auto; /* Center the table horizontally */
    }

    .table th,
    .table td {
        text-align: center; /* Ensure table headers and data are centered */
        vertical-align: middle; /* Center vertically */
    }
</style>



<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders (In-House)<h5>
        </div>
        <div class="card-body px-3 mt-3">
            <?php alertMessage(); ?>
            <?php
            // Fetch orders
            $order = getAll( 'orders');
            
            // Fetch customers and convert result to array
            $cusResult = getAll('bcustomers');
            $cusName = [];
            if ($cusResult && mysqli_num_rows($cusResult) > 0) {
                while ($row = mysqli_fetch_assoc($cusResult)) {
                    $cusName[] = $row; // Store each customer row as an array
                }
            }

            if ($order === false || empty($cusName)) { // Check if fetching failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($order) > 0) {
                $orders = [];
                while ($b_orderItem = mysqli_fetch_assoc($order)) {
                    $orders[] = $b_orderItem; // Store each order in an array
                }

                // Reverse the array to display the most recent orders first
                $orders = array_reverse($orders);
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Guest Name</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Order Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through reversed orders and display related customer details
                            foreach ($orders as $b_orderItem) :
                                $customerId = $b_orderItem['customer_id']; // Get customer ID from the order
                                // Find customer data by matching the ID
                                $customer = array_filter($cusName, function ($cus) use ($customerId) {
                                    return $cus['id'] == $customerId;
                                });
                                $customer = reset($customer); // Get the first matched customer
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($b_orderItem['id']); ?></td>
                                    <td>
                                        <?= htmlspecialchars(
                                            $customer['title'] . ' ' . $customer['fname'] . ' ' . $customer['lname']
                                        ); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['total_price']); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['status']); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['order_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<h4 class="mb-0">No Records Found</h4>';
            }
            ?>
        </div>
    </div>
</div>


    



<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders (Walk-In)</h5>
        </div>
        <div class="card-body px-3 mt-3">
            <?php alertMessage(); ?>
            <?php
            // Fetch orders
            $w_order = getAll('w_orders');
            
            // Fetch customers and convert result to array
            $cusResult = getAll('w_customers');
            $cusName = [];
            if ($cusResult && mysqli_num_rows($cusResult) > 0) {
                while ($row = mysqli_fetch_assoc($cusResult)) {
                    $cusName[] = $row; // Store each customer row as an array
                }
            }

            if ($w_order === false || empty($cusName)) { // Check if fetching failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($w_order) > 0) {
                $orders = [];
                while ($b_orderItem = mysqli_fetch_assoc($w_order)) {
                    $orders[] = $b_orderItem; // Store each order in an array
                }

                // Reverse the array to display the most recent orders first
                $orders = array_reverse($orders);
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Guest Name</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Order Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through reversed orders and display related customer details
                            foreach ($orders as $b_orderItem) :
                                $customerId = $b_orderItem['customer_id']; // Get customer ID from the order
                                // Find customer data by matching the ID
                                $customer = array_filter($cusName, function ($cus) use ($customerId) {
                                    return $cus['id'] == $customerId;
                                });
                                $customer = reset($customer); // Get the first matched customer
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($b_orderItem['id']); ?></td>
                                    <td><?= htmlspecialchars($customer['name']); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['total_price']); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['status']); ?></td>
                                    <td><?= htmlspecialchars($b_orderItem['order_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<h4 class="mb-0">No Records Found</h4>';
            }
            ?>
        </div>
    </div>
</div>



<?php include('includes/footer.php') ?>