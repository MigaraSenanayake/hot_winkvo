<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Room Package
                <a href="rooms.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $package_Id = trim($_GET['id']);
                    if (!empty($package_Id)) {
                        $package_Data = getById('room_cat', $package_Id);

                        if ($package_Data && $package_Data['status'] == 200) {
                            $room_cat = $package_Data['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($package_Data['message']) . '</h5>';
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

                <!-- Hidden input to store room cat. ID -->
                <input type="hidden" name="package_Id" value="<?= htmlspecialchars($room_cat['id']); ?>">

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="cat_code">Cate. Code *</label>
                        <input type="text" name="cat_code" value="<?= htmlspecialchars($room_cat['cat_code']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="cat">Category *</label>
                        <select name="cat" class="form-select" required>
                            <option value="" disabled>Select a Cate.</option>                            
                            <option <?= (isset($room_cat['cat']) && $room_cat['cat'] == 'Supirior Deluxe') ? 'selected' : ''; ?>>Supirior Deluxe</option>
                            <option <?= (isset($room_cat['cat']) && $room_cat['cat'] == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>                            
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="type">Room Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled>Select a Cate.</option>                            
                            <option <?= (isset($room_cat['type']) && $room_cat['type'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option <?= (isset($room_cat['type']) && $room_cat['type'] == 'Double') ? 'selected' : ''; ?>>Double</option>
                            <option <?= (isset($room_cat['type']) && $room_cat['type'] == 'Thriple') ? 'selected' : ''; ?>>Thriple</option>
                        </select>
                    </div>                    

                    <div class="col-md-6 mb-4">
                        <label for="meal_plan">Meal Plan *</label>
                        <select name="meal_plan" class="form-select" required>
                            <option value="" disabled>Select a Plan</option>
                            <option <?= (isset($room_cat['meal_plan']) && $room_cat['meal_plan'] == 'Room Only') ? 'selected' : ''; ?>>Room Only</option>
                            <option <?= (isset($room_cat['meal_plan']) && $room_cat['meal_plan'] == 'Bed and Breakfast') ? 'selected' : ''; ?>>Bed and Breakfast</option>
                            <option <?= (isset($room_cat['meal_plan']) && $room_cat['meal_plan'] == 'Half Board') ? 'selected' : ''; ?>>Half Board</option>
                            <option <?= (isset($room_cat['meal_plan']) && $room_cat['meal_plan'] == 'Full Board') ? 'selected' : ''; ?>>Full Board</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="r_num">Room No. *</label>
                        <input type="number" name="r_num"  value="<?= htmlspecialchars($room_cat['r_num']); ?>" class="form-control" />
                    </div>

                   

                    <div class="col-md-6 mb-4">
                        <label for="price">Room Price *</label>
                        <input type="number" name="price" required value="<?= htmlspecialchars($room_cat['price']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="s_charge">Ser. Charge *</label>
                        <input type="number" name="s_charge" required value="<?= htmlspecialchars($room_cat['s_charge']); ?>" class="form-control" />
                    </div>
    

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="update_room_cat" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
