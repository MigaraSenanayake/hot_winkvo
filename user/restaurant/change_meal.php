<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Change Meal Plan
                <a href="b_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="../code.php" method="POST" enctype="multipart/form-data">
                <?php 
                
                if (isset($_GET['id'])) {
                    $b_cus_Id = trim($_GET['id']);
                    if (!empty($b_cus_Id)) {
                        $b_cus_Data = getById('bcustomers', $b_cus_Id);
                        if ($b_cus_Data && $b_cus_Data['status'] == 200) {
                            $b_customer = $b_cus_Data['data'];

                            
                           
                        } else {
                            echo '<h5>' . htmlspecialchars($b_cus_Data['message']) . '</h5>';
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

                <input type="hidden" name="b_cus_Id" value="<?= htmlspecialchars($b_customer['id'] ?? ''); ?>">

                <div class="row">

                <div class="col-md-4 mb-4">
                    <label for="fname" value="fname">Name :   <?= htmlspecialchars($b_customer['title']) . ' ' . htmlspecialchars($b_customer['fname']) . ' ' . htmlspecialchars($b_customer['lname']); ?></label>
                                                
                </div>

                <div class="col-md-4 mb-4">
                        <label for="r_num">Room Number :   <?= htmlspecialchars($b_customer['r_num'])?></label>
                        
                </div>

                <div class="col-md-4 mb-4">
                        <label for="phone">Contact No :   <?= htmlspecialchars($b_customer['phone'])?></label>
                        
                </div>

               <br>

                <div class="col-md-6 mb-4">
                    <label for="meal_plan">Meal Plan *</label>
                    <select name="meal_plan" class="form-select" required>
                        <option value="" disabled>Select Meal Plan</option>
                        <option <?= (isset($b_customer['meal_plan']) && $b_customer['meal_plan'] == 'Need not Food or Drink') ? 'selected' : ''; ?>>Need not Food or Drink</option>
                        <option <?= (isset($b_customer['meal_plan']) && $b_customer['meal_plan'] == 'Bed and Breakfast') ? 'selected' : ''; ?>>Bed and Breakfast</option>
                        <option <?= (isset($b_customer['meal_plan']) && $b_customer['meal_plan'] == 'Half Board') ? 'selected' : ''; ?>>Half Board</option>
                        <option <?= (isset($b_customer['meal_plan']) && $b_customer['meal_plan'] == 'Full Board') ? 'selected' : ''; ?>>Full Board</option>
                    </select>
                </div>
                           
                    

                <div class="row mt-3 mb-3">
                    <div class="col-md-12">
                        <button type="submit" name="change_meal" class="btn btn-success float-end">Change Meal Plan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>
