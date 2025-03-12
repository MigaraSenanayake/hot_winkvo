<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Save Walk-In Guest Details
                <a href="w_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="../code.php" method="POST" enctype="multipart/form-data">
                <div class="row">          

                <div class="col-md-2 mb-4">
                        <label for="title">Title *</label>
                        <select name="title" class="form-select" required>
                            <option value="" disabled selected>Select Title</option>    
                            <option>Mr.</option>
                            <option>Mrs.</option>
                            <option>Rev.</option>                            
                        </select>
                    </div>          
                    <div class="col-md-10 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>                     
                     <div class="col-md-12 mb-4">
                        <label for="bname">Billing Name (For Co-operate Guest) *</label>
                        <input type="text" name="bname" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="address">Address *</label>
                        <input type="text" name="address" required class="form-control" />
                    </div>     
                    <div class="col-md-6 mb-4">
                        <label for="nic_pp">NIC or Passport Number *</label>
                        <input type="text" name="nic_pp" required class="form-control" />
                    </div>                 
                    <div class="col-md-6 mb-4">
                        <label for="phone">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control" />
                    </div>                  
                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
                    
                    

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_w_cus" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>
