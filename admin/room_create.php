<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Room Package
                <a href="rooms.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="cat_code">Cate. Code *</label>
                        <input type="text" name="cat_code" class="form-control" placeholder="SDSBB"/>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="cat">Category *</label>
                        <select name="cat" class="form-select" required>
                            <option value="" disabled selected>Select Category</option>    
                            <option>Supirior Deluxe</option>
                            <option>Deluxe</option>                                                       
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="type">Room Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled selected>Select Type</option>    
                            <option>Single</option>
                            <option>Double</option>
                            <option>Triple</option>                                                       
                        </select>
                    </div>                   
                    <div class="col-md-6 mb-4">
                        <label for="meal_plan">Meal Plan *</label>
                        <select name="meal_plan" class="form-select" required>
                            <option value="" disabled selected>Select Plan</option>    
                            <option>Room Only</option>
                            <option>Bed and Breakfast</option>
                            <option>Half Board</option>
                            <option>Full Board</option>                            
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="r_num">Room No *</label>
                        <input type="number" name="r_num" class="form-control" />
                    </div>
                                     
                    <div class="col-md-6 mb-4">
                        <label for="price">Room Price *</label>
                        <input type="number" name="price" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="s_charge">Ser. Charge *</label>
                        <input type="number" name="s_charge" required class="form-control" />
                    </div>
                    

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_room_cat" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

<?php include('includes/footer.php'); ?>
