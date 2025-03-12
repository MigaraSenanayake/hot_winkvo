<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">List of Food & Beverages
                
            </h4>
        </div>
        <div class="card-body px-3 mt-3">
            <?php alertMessage(); ?>

            <?php
            $menu = getAll('menu');
            if ($menu === false) {
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($menu) > 0) {
            ?>
               <!-- Search Bar with Icon -->
                <div class="col-md-6 mb-4 position-relative">
                    <input type="text" id="searchInput" class="form-control pr-5" placeholder="Search by Name or Category..." onkeyup="filterTable()" />
                    <i class="fas fa-search position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                </div>


                <!-- Table Scrollable Container -->
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 330px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" id="menuTable">
                        <thead>
                            <tr>
                                <th><center>Item Id</center></th>
                                <th><center>Category</center></th>
                                <th><center>Name</center></th>
                                <th><center>Price</center></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $menuItem) : ?>
                                <tr>
                                    <td><center><?= htmlspecialchars($menuItem['id']) ?></center></td>
                                    <td><center><?= htmlspecialchars($menuItem['menu_cat']) ?></center></td>
                                    <td><?= htmlspecialchars($menuItem['name']) ?></td>
                                    <td><center>LKR <?= htmlspecialchars($menuItem['price']); ?></center></td>                                 
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
