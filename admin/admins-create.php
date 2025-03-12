<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Admin
                <a href="admins.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form id="passwordForm" action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="phone">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control" />
                    </div>
                
                    <div class="col-md-6 mb-4">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required class="form-control" />
                        <div id="password-message" class="validation-message"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="confirm-password">Confirm Password *</label>
                        <input type="password" id="confirm-password" name="conf_password" required class="form-control" />
                        <div id="confirm-password-message" class="validation-message"></div>
                    </div>

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="saveAdmin" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="form_validation.js"></script>
<link rel="stylesheet" href="styles.css">

<?php include('includes/footer.php'); ?>
