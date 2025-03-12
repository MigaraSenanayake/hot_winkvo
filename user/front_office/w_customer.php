<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Walk-In Guests
                <a href="w_cus_create.php" class="btn btn-outline-success float-end">Register</a>                
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $w_cus = getAll('w_customers');
            if ($w_cus === false) { // Check if fetching admins failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($w_cus) > 0) {
            ?>   
                <!-- Top Scrollbar Container -->
                <div id="top-scroll" class="overflow-auto mb-2" style="overflow-x: auto;">
                    <div style="width: max-content;"></div>
                </div>

                <!-- Search Bar with Icon -->
                <div class="col-md-6 mb-4 position-relative">
                    <input type="text" id="searchNIC" class="form-control pr-5" placeholder="Type NIC/Passport to check if already registered..." onkeyup="filterbyNIC()" />
                    <i class="fas fa-search position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                </div>

                <!-- Table Scrollable Container -->
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 400px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" id="bcusTable">
                        <thead>
                            <tr>
                                <th>ID</th>                                
                                <th>Name</th>
                                <th>Billing Name</th>
                                <th>Contact</th>
                                <th>Email</th> 
                                <th>NIC/Passport No.</th>                                                                                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($w_cus as $w_cusItem) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($w_cusItem['id']); ?></td>                                    
                                    <td><?= htmlspecialchars($w_cusItem['title']) . ' ' . htmlspecialchars($w_cusItem['name']); ?></td>
                                    <td><?= htmlspecialchars($w_cusItem['bname']); ?></td>
                                    <td><?= htmlspecialchars($w_cusItem['phone']); ?></td>
                                    <td><?= htmlspecialchars($w_cusItem['email']); ?></td> 
                                    <td><?= htmlspecialchars($w_cusItem['nic_pp']); ?></td>      
                                    <td>
                                        <a href="w_cus_edit.php?id=<?= htmlspecialchars($w_cusItem['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
                                        <a href="w_cus_reCreate.php?id=<?= htmlspecialchars($w_cusItem['id']); ?>" class="btn btn-outline-success btn-sm">Re-register</a>
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
</div>

<?php include('includes/footer.php'); ?>



<script src="../../admin/assets/js/filter.js"></script>