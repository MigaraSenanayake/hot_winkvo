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
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 380px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" style="width: max-content;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Code</th>
                                <th>Category</th>
                                <th>Room Type</th>
                                <th>Meal Plan</th>                               
                                <th>Price</th>
                                <th>Ser. Charge</th>
                                <th>Total Rate</th>
                                <th>Action</th>
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
                                    <td><?= htmlspecialchars($room_cat_Item['price']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['s_charge']); ?></td>
                                    <td><?= htmlspecialchars($room_cat_Item['r_total']); ?></td>
                                    <td>
                                        <a href="room_edit.php?id=<?= htmlspecialchars($room_cat_Item['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
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
