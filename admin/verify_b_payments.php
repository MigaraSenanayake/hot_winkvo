<?php


// Define the getAllWithCondition function
function getAllWithCondition($table, $condition) {
    global $conn; // Use your database connection
    $query = "SELECT * FROM $table WHERE $condition";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn)); // Debugging help
    }

    return $result;
}

include('includes/header.php'); 
?>
<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Verify Payments (In-House)
                <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form method="POST" action="update_payment_status.php"> <!-- Form wrapping the table -->
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 330px; overflow-x: auto;">
                    <?php
                    // Fetch only payments with status 'Pending'
                    $payments = getAllWithCondition('payments', "status = 'Pending'");

                    if (mysqli_num_rows($payments) > 0) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cust. ID</th>
                                    <th>Payment Date &amp; Time</th>
                                    <th>Booking</th>
                                    <th>Bill Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($paymentItems = mysqli_fetch_assoc($payments)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($paymentItems['id']); ?></td>
                                        <td><?= htmlspecialchars($paymentItems['customer_id']); ?></td>
                                        <td><?= htmlspecialchars($paymentItems['payment_date']); ?></td>
                                        <td><?= htmlspecialchars($paymentItems['booking']); ?></td>
                                        <td><?= htmlspecialchars($paymentItems['bill_total']); ?></td>
                                        <td>
                                            <input type="checkbox" name="payment_ids[]" value="<?= $paymentItems['id']; ?>" style="height: 30px; width: 30px; margin-right:15px;" />
                                        </td>
                                        <td>
                                            <a href="payments-edit.php?id=<?= htmlspecialchars($paymentItems['id']); ?>" class="btn btn-outline-primary btn-sm">Change</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    } else {
                        echo '<h4 class="mb-0">No Pending Payments Found</h4>';
                    }
                    ?>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-success mt-1 float-end">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
