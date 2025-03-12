<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Room Packages
                <a href="room_create.php" class="btn btn-outline-success float-end">Add Packages</a>
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            

            <?php
            $room_cat = getAll('room_cat');
            if ($room_cat === false) { // Check if fetching room_cats failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($room_cat) > 0) {
            ?>

                <!-- Search Bar with Icon -->
                <div class="col-md-6 mb-4 position-relative">
                    <input type="text" id="searchRInput" class="form-control pr-5" placeholder="Search by ID / Category / Type or Meal Plan..." onkeyup="filterTable()" />
                    <i class="fas fa-search position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                </div>

                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 330px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" id="roomTable">
                        <thead>
                            <tr>
                                <th>ID</th>   
                                <th>Cate. Code</th>                             
                                <th>Category</th>
                                <th>Room Type</th>
                                <th>Meal Plan</th>
                                <th>Room No.</th>
                                <th>Price</th> 
                                <th>Ser. Charge</th>
                                <th>Total Rate</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($room_cat as $room_cat_Item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($room_cat_Item['id']); ?></td>                                    
                                    <td><?= htmlspecialchars($room_cat_Item['cat_code']); ?></td>                                    
                                    <td><?= htmlspecialchars($room_cat_Item['cat']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['type']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['meal_plan']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['r_num']); ?></td>                                   
                                    <td><?= htmlspecialchars($room_cat_Item['price']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['s_charge']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['r_total']); ?></td>                                  
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