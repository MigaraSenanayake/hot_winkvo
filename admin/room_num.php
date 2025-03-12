<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Rooms
                <a href="room_num_create.php" class="btn btn-outline-success float-end">Add Room</a>
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            

            <?php
            $room = getAll('room');
            if ($room === false) { // Check if fetching rooms failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($room) > 0) {
            ?>
  
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 370px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" id="roomTable">
                        <thead>
                            <tr>
                                <th>ID</th>   
                                <th>Room Category</th>   
                                <th>Room Name</th>   
                                <th>Room No.</th> 
                                <th>Action</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($room as $room_Item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($room_Item['id']); ?></td> 
                                    <td><?= htmlspecialchars($room_Item['room_cat']); ?></td>
                                    <td><?= htmlspecialchars($room_Item['room_name']); ?></td>
                                    <td><?= htmlspecialchars($room_Item['room_no']); ?></td>  
                                    <td>
                                        <a href="room_num_edit.php?id=<?= htmlspecialchars($room_Item['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
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