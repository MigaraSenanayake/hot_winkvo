<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">List of Food & Beverages
                <a href="menu_create.php" class="btn btn-outline-success float-end">Add F or B Item</a>
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $menu = getAll('menu');
            if ($menu === false) { // Check if fetching menu failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($menu) > 0) {
            ?>
                <!-- Top Scrollbar Container -->
                <div id="top-scroll" class="overflow-auto mb-2" style="overflow-x: auto;">
                    <div style="width: max-content;"></div>
                </div>

                <!-- Table Scrollable Container -->
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 400px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th><center>Item Id</center></th>                                
                                <th><center>Category</center></th>
                                <th><center>Name</center></th>
                                <th><center>Price</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $menuItem) : ?>
                                <tr>
                                    <td><center><?=htmlspecialchars($menuItem['id'])?></center></td>                                    
                                    <td><center><?=htmlspecialchars($menuItem['menu_cat'])?></center></td>
                                    <td><?= htmlspecialchars($menuItem['name'])?></td>
                                    <td><center>LKR <?= htmlspecialchars($menuItem['price']); ?></center></td>
                                    <td>
                                        <center><a href="menu_edit.php?id=<?= htmlspecialchars($menuItem['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a></center>
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
