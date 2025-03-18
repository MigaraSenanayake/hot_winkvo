<link href="../../admin/assets/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Create Order (In-House Guest)
                <a href="fo_index.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body px-3 mt-2">
            <?php alertMessage(); ?>      
                    
                <form action="order_code2.php" method="POST">
                    
                    <div class="row">      
                
                    <!-- Item ID Input -->
                    <div class="col-md-3 mb-4">
                        <label for="searchId">Item ID *</label>
                        <input type="number" name="searchId" id="searchId" required class="form-control" placeholder="Enter ID here.." min="1" />
                    </div>

                    <!-- Item Name Display -->
                    <div class="col-md-9 mb-4">
                        <label for="itemName">Item Name *</label>
                        <input type="text" name="itemName" id="itemName" class="form-control" readonly />
                    </div>                     
                    
                    <!-- Quantity Input -->
                    <div class="col-md-3 mb-4">
                        <label for="qty">Quantity *</label>
                        <input type="number" name="qty" id="qty" value="1" class="form-control" min="1" required />
                    </div>    
                    
                    <!-- Unit Price Display -->
                    <div class="col-md-3 mb-4">
                        <label for="itemPrice">Unit Price *</label>
                        <input type="text" id="itemPrice" name="price" class="form-control" readonly />
                    </div>

                    <!-- Amount Display -->
                    <div class="col-md-3 mb-4">
                        <label for="amount">Amount *</label>
                        <input type="text" id="amount" class="form-control" readonly />
                    </div>

                    <div class="col mt-3 mb-3 text-end">      
                        <button type="submit" name="addItem" class="btn btn-outline-primary">Add Item</button>
                    </div>                    
                    </div>
                </form>           
            
        </div>
      
    </div>
    <div class="card mt-3">
    <div class="card-header">
        <h4 class="mb-0">Cart</h4>        
        
    </div>
    <div class="card-body px-3 mt-2">        

        <form action="order_code2.php" method="POST">
                    
            <div class="row">      
            
            <!-- Item Name Display -->
            <div class="col-md-6 mb-4">
                <label for="citemName">Custom Item Name *</label>
                <input type="text" name="citemName" id="citemName" class="form-control" />
            </div>             
            
            <!-- Quantity Input -->
            <div class="col-md-3 mb-4">
                <label for="cQty">Quantity *</label>
                <input type="number" name="cQty" id="cQty" value="1" class="form-control" min="1" />
            </div>    
            
            <!-- Unit Price Display -->
            <div class="col-md-3 mb-4">
                <label for="cItemPrice">Unit Price *</label>
                <input type="number" id="cItemPrice" name="cItemPrice" class="form-control" />
            </div>           

            <div class="col mt-3 mb-3 text-end">      
                <button type="submit" name="addC_Item" class="btn btn-outline-primary">Add Custom Item</button>
            </div>
            
            </div>
        </form>

        <?php
            if(isset($_SESSION['order_items']) && !empty($_SESSION['order_items']))
            {
                $sessionItems = $_SESSION['order_items'];
                if(empty($sessionItems)){
                    unset($_SESSION['order_itemIds']);
                    unset($_SESSION['order_items']);
                }
                ?>
                    <div class="table-responsive mb-3">
                    <div id="table-scroll" class="table-responsive overflow-auto" style="overflow-x: auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>  
                                <th>Price</th>                                  
                                <th>Quantity</th>
                                <th>Total</th>                                  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($sessionItems as $key => $order_item) : 
                                $isCustom = is_null($order_item['item_id']); // Check if it's a custom item
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($i++); ?></td>
                                <td><?= htmlspecialchars($order_item['name']); ?> <?= $isCustom ? "(Custom)" : ""; ?></td>
                                <td>LKR <?= number_format($order_item['price'], 2); ?></td>
                                <td><?= htmlspecialchars($order_item['qty']); ?></td>
                                <td>LKR <?= number_format($order_item['price'] * $order_item['qty'], 2); ?></td>
                                <td>
                                    <a href="order_item_delete2.php?index=<?= $key; ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php
            }
            else
            {
                echo '<h5>Items Not Added</h5>';
            }

        ?>
        


        <form action="order_code2.php" method="POST">
           <div class="row">
                <div class="col-md-6 mb-2 ">
                    <label>NIC or Passport No *</label>
                    <select name="cusId" id="cusId" class="form-select js-mySelect2">
                        <option value="" readonly selected>Select Here</option>
                        <?php                            
                            $name = mysqli_query($conn, "SELECT * FROM bcustomers WHERE departure > CURDATE()");
                            if ($name && mysqli_num_rows($name) > 0) {
                                foreach ($name as $cusData) {
                                    echo '<option value="'.$cusData['id'].'">'.$cusData['nic_pp'].'  -  '.$cusData['title'].' '.$cusData['fname'].' '.$cusData['lname'].'</option>';
                                }
                            } else {
                                echo '<option value="">No Customers Found</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="location">Location *</label>
                    <select name="location" id="location" class="form-select" required>
                        <option value="" readonly selected>Select Location</option>
                        <option value="room">Room</option>
                        <option value="restaurant">Restaurant</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tableOrRoom">Table No or Room No</label>
                    <input type="text" name="tableOrRoom" id="tableOrRoom" class="form-control" >
                </div>

                <div class="col-md-6 mb-3">
                    <label for="readyTime">Ready By (Time) *</label>
                    <input type="datetime-local" name="readyTime" id="readyTime" class="form-control" required />
                </div>

                <div class="col-md-12 mb-3">
                    <label for="remarks">Special Remarks (If Need) *</label>
                    <input type="text" name="remarks" id="remarks" class="form-control" />
                </div>

                <div class="col mt-3 mb-2 text-end">      
                    <button type="submit" name="submitOrder" class="btn btn-success">Create Order</button>
                </div>
           </div>
        </form>
    </div>
</div>



<script src="../../admin/assets/js/display_name.js"></script>
<!-- <script src="../../assets/form_validation.js"></script> -->
<link rel="stylesheet" href="../../assets/styles.css">
<script src="../../admin/assets/js/display_name.js"></script>

<?php include('includes/footer.php'); ?>