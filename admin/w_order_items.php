<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Total Selled Items
                <a href="admins-create.php" class="btn btn-outline-success float-end">Print</a>
                <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>               
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $item = getAll('menu');
            if ($item === false) { // Check if fetching item failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($item) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              
                                <th>Item ID</th>
                                <th>Name</th>
                                <th>Qty</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item as $items) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($items['id']); ?></td>
                                    <td><?= htmlspecialchars($items['name']); ?></td>
                                    <td><?= htmlspecialchars($items['']); ?></td>
                                    
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
<script src="../../admin/assets/js/filter.js"></script>
<?php include('includes/footer.php'); ?>
