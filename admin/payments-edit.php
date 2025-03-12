<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Payment Details
                <a href="verify_b_payments.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $paymentId = trim($_GET['id']);
                    if (!empty($paymentId)) {
                        $paymentData = getById('payments', $paymentId);

                        if ($paymentData && $paymentData['status'] == 200) {
                            $payment = $paymentData['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($paymentData['message']) . '</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>Id Not Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Id Not given in parameters</h5>';
                    return false;
                }
                ?>

                <!-- Hidden input to store payment ID -->
                

                <div class="row">

                

                    <div class="col-md-2 mb-4">
                        <label for="id">Payment ID *</label>
                        <input type="text" name="paymentId" value="<?= htmlspecialchars($payment['id']); ?>" class="form-control" readonly/>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label for="customer_id">Customer ID *</label>
                        <input type="customer_id" id="customer_id" name="customer_id"  value="<?= htmlspecialchars($payment['customer_id']); ?>" class="form-control" readonly/>                         
                    </div>
                    <div class="col-md-8 mb-4">
                        <label for="booking">Booking *</label>
                        <input type="text" name="booking" value="<?= htmlspecialchars($payment['booking']); ?>" class="form-control" readonly/>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="payment_date">Payment Date &amp; Time *</label>
                        <input type="datetime-local" name="payment_date" required value="<?= htmlspecialchars($payment['payment_date'] ?? ''); ?>" class="form-control" />
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="bill_total">Bill Total *</label>
                        <input type="number" name="bill_total" min="1" required value="<?= htmlspecialchars($payment['bill_total']); ?>" class="form-control" />
                    </div>               

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="updatePayment" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="form_validation.js"></script>
<link rel="stylesheet" href="styles.css">

<?php include('includes/footer.php'); ?>
