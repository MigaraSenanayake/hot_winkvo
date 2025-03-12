<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Verify Order Payments (In-House)
                
                <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>               
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form method="POST" action="update_status.php"> 
                <div class="row">
                
                

                    <!-- Payments Table -->
                    <div class="col-md-6">
                        <h5>Payments</h5>
                        <?php
                        $payments = getAll('payments');
                        if ($payments === false) { 
                            echo '<h4>Something Went Wrong!</h4>';
                        } elseif (mysqli_num_rows($payments) > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cust. ID</th>
                                            <th>Order IDs</th>
                                            <th>Bill Total</th>
                                            <th>Payment Date &amp; Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($payments as $paymentItems) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($paymentItems['id']); ?></td>
                                                <td><?= htmlspecialchars($paymentItems['customer_id']); ?></td>
                                                <td><?= htmlspecialchars($paymentItems['order_ids']); ?></td>
                                                <td><?= htmlspecialchars($paymentItems['bill_total']); ?></td>                                                                                   
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            echo '<h4 class="mb-0">Record Not Found</h4>';
                        }
                        ?>
                    </div>

                    <!-- Orders Table -->
                    <div class="col-md-6">
                        <h5>Orders</h5>
                        <?php
                        $orders = getAll('orders');
                        if ($orders === false) { 
                            echo '<h4>Something Went Wrong!</h4>';
                        } elseif (mysqli_num_rows($orders) > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cust. ID</th>                                
                                            <th>Order Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $orderItems) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($orderItems['id']); ?></td>
                                                <td><?= htmlspecialchars($orderItems['customer_id']); ?></td>                                    
                                                <td><?= htmlspecialchars($orderItems['total_price']); ?></td>
                                                <td>
                                                <?php if ($orderItems['status'] !== 'paid') : ?>
                                                        <input type="checkbox" name="order_ids[]" value="<?= $orderItems['id']; ?>" style="height: 30px; width: 30px; margin-right:15px;" />
                                                    <?php else: ?>
                                                        <!-- No checkbox if order is already paid -->
                                                        <span class="text-muted">Paid</span>
                                                    <?php endif; ?>
                                                </td>                                   
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            echo '<h4 class="mb-0">Record Not Found</h4>';
                        }
                        ?>
                    </div>
                </div>
                <div><button type="submit" class="btn btn-primary mt-1 float-end">Mark as Paid</button> <!-- Submit Button inside form --></div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
