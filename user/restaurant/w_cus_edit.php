<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Walk-In Guest Details
                <a href="w_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="../code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $w_cus_Id = trim($_GET['id']);
                    if (!empty($w_cus_Id)) {
                        $w_cus_Data = getById('w_customers', $w_cus_Id);

                        if ($w_cus_Data && $w_cus_Data['status'] == 200) {
                            $w_customer = $w_cus_Data['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($w_cus_Data['message']) . '</h5>';
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

                <!-- Hidden input to store admin ID -->
                <input type="hidden" name="w_cus_Id" value="<?= htmlspecialchars($w_customer['id']); ?>">

                <div class="row">

                <div class="col-md-2 mb-4">
                        <label for="title">Title *</label>
                        <select name="title" class="form-select" required>                            
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.</option>
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Mrs.') ? 'selected' : ''; ?>>Mrs.</option>
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Rev.') ? 'selected' : ''; ?>>Rev.</option>
                        </select>
                    </div>
                    <div class="col-md-10 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($w_customer['name']); ?>" class="form-control" />
                    </div>                     
                     <div class="col-md-12 mb-4">
                        <label for="bname">Billing Name (For Co-operate Guest) *</label>
                        <input type="text" name="bname" value="<?= htmlspecialchars($w_customer['bname']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="address">Address *</label>
                        <input type="text" name="address" required value="<?= htmlspecialchars($w_customer['address']); ?>" class="form-control" />
                    </div>  
                    
                    <div class="col-md-6 mb-4">
                        <label for="nic_pp">NIC or Passport Number *</label>
                        <input type="text" name="nic_pp" required value="<?= htmlspecialchars($w_customer['nic_pp']); ?>" class="form-control" />
                    </div> 

                    <div class="col-md-6 mb-4">
                        <label for="phone">Phone Number *</label>
                        <input type="number" name="phone" required value="<?= htmlspecialchars($w_customer['phone']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($w_customer['email'] ?? ''); ?>"class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
             
               

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="edit_w_cus" class="btn btn-outline-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
   

<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>
