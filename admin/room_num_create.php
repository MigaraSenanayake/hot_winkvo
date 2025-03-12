<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Room
                <a href="room_num.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">
                <div class="row">
                   
                    <div class="col-md-4 mb-4">
                        <label for="room_cat">Category *</label>
                        <select name="room_cat" class="form-select" required>
                            <option value="" disabled selected>Select Category</option>    
                            <option>Supirior Deluxe</option>
                            <option>Deluxe</option>                                                       
                        </select>
                    </div>  
                    
                    <div class="col-md-4 mb-4">
                        <label for="room_name">Room Name *</label>
                        <input type="text" name="room_name" class="form-control" placeholder="Eg. SD101"/>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <label for="room_no">Room No *</label>
                        <input type="number" name="room_no" class="form-control" />
                    </div>
                            
                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_room" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

<?php include('includes/footer.php'); ?>
