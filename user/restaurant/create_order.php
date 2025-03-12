<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Create Order (Walk-In Guest)
                <a href="r_index.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="order_code.php" method="POST">
                <div class="row">
                    <!-- Item ID Input -->
                    <div class="col-md-4 mb-4">
                        <label for="searchId">Item ID *</label>
                        <input type="number" name="searchId" id="searchId" required class="form-control" placeholder="Enter ID here.." />
                    </div>

                    <!-- Item Name Display -->
                    <div class="col-md-8 mb-4">
                        <label for="itemName">Item Name *</label>
                        <input type="text" name="itemName" id="itemName" class="form-control" disabled />
                    </div>                    

                    <!-- Quantity Input -->
                    <div class="col-md-3 mb-4">
                        <label for="qty">Quantity *</label>
                        <input type="number" name="qty" id="qty" value="1" class="form-control" min="1" required />
                    </div>    
                    
                    <!-- Unit Price Display -->
                    <div class="col-md-3 mb-4">
                        <label for="itemPrice">Unit Price *</label>
                        <input type="text" id="itemPrice" name="price" class="form-control" disabled />
                    </div>

                    <!-- Amount Display -->
                    <div class="col-md-3 mb-4">
                        <label for="amount">Amount *</label>
                        <input type="text" id="amount" class="form-control" disabled />
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
        <form action="order_code.php" method="POST">
           <div class="row">
            
                <div class="col-md-8 mb-2">
                    <label>NIC or Passport No *</label>
                    <select name="cusId" id="cusId" class="form-select js-mySelect2">
                        <option value="" disabled selected>Select Here</option>
                        <?php
                            $name = getAll('w_customers');
                            if ($name && mysqli_num_rows($name) > 0) {
                                foreach ($name as $nameItems) {
                                    echo '<option value="'.$nameItems['id'].'">'.$nameItems['nic_pp'].'</option>';
                                }
                            } else {
                                echo '<option value="">No Customers Found</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <div class="col mt-3 mb-2 text-end">      
                    <button type="submit" name="submitOrder" class="btn btn-outline-success">Create Order</button>
                </div>
           </div>

        </form>

    <div class="card-body">
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
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                       
                                    foreach($sessionItems as $key => $order_item) : 
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($i++); ?></td>
                                    <td><?= htmlspecialchars($order_item['name']); ?></td>
                                    <td>LKR <?= number_format($order_item['price'], 2); ?></td>
                                    <td><?= htmlspecialchars($order_item['qty']); ?></td>
                                    <td>LKR <?= number_format($order_item['price'] * $order_item['qty'] , 2); ?></td>
                                    <td>
                                        <a href="order_item_delete.php?index=<?= $key; ?>" class="btn btn-outline-danger">
                                            Remove
                                        </a>
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
                echo '<h5>No Items Added</h5>';
            }
        ?>
    </div>
</div>

<!-- Add JavaScript to focus on the Item ID field when the page loads -->
<script>
    window.onload = function() {
        document.getElementById('searchId').focus();
    };
</script>

<?php include('includes/footer.php'); ?>
