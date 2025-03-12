<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Room
                <a href="room_num.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $room_Id = trim($_GET['id']);
                    if (!empty($room_Id)) {
                        $room_Data = getById('room', $room_Id);

                        if ($room_Data && $room_Data['status'] == 200) {
                            $room = $room_Data['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($room_Data['message']) . '</h5>';
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

                <!-- Hidden input to store room. ID -->
                <input type="hidden" name="room_Id" value="<?= htmlspecialchars($room['id']); ?>">

                <div class="row">
                    
                    <div class="col-md-6 mb-4">
                        <label for="room_cat">Category *</label>
                        <select name="room_cat" class="form-select" required>
                            <option value="" disabled>Select a Cate.</option>                            
                            <option <?= (isset($room['room_cat']) && $room['room_cat'] == 'Supirior Deluxe') ? 'selected' : ''; ?>>Supirior Deluxe</option>
                            <option <?= (isset($room['room_cat']) && $room['room_cat'] == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>                            
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="room_name">Room Name *</label>
                        <input type="text" name="room_name" required value="<?= htmlspecialchars($room['room_name']); ?>" class="form-control" />
                    </div>
                               
                    <div class="col-md-6 mb-4">
                        <label for="room_no">Room No. *</label>
                        <input type="number" name="room_no"  value="<?= htmlspecialchars($room['room_no']); ?>" class="form-control" />
                    </div>
       
                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="update_room" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
