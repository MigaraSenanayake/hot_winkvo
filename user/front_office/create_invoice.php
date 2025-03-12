<link href="../../admin/assets/css/select2.css" rel="stylesheet" />
<?php include('includes/header.php'); ?>



<div class="modal fade" id="CalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Currency Value Calculator</h1>        
      </div>
      <div class="modal-body">
        <div class="mb-4">
            <label>Total Price *</label>
            <input type="text" class="form-control" id="totalPriceCal" readonly>
        </div>
        <div class="mb-4">
            <label>Currency Value in Rupees *</label>
            <input type="text" class="form-control" id="otherCurre" placeholder="Enter here other currency value">
        </div>
        <div class="mb-4">
            <label>Total Price in Other Currency *</label>
            <input type="text" class="form-control" id="priceOther" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Card Payment</h1>
        
      </div>
      <div class="modal-body">
        <div class="mb-4">
            <label>Card No. (Last 4 Numbers) *</label>
            <input type="text" class="form-control" id="cardNo" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="cardBtn" class="btn btn-primary">Print Bill</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cash Payment</h1>
        
      </div>
      <div class="modal-body">
        <div class="mb-4">
            <label>Total Price *</label>
            <input type="text" class="form-control" id="totalPriceCash" readonly>
        </div>
        <div class="mb-4">
            <label>Cash *</label>
            <input type="number" class="form-control" id="cashInput" placeholder="Enter Cash Amount" required>
        </div>
        <div class="mb-4">
            <label>Balance *</label>
            <input type="text" class="form-control" id="balanceOutput" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="cashBtn" class="btn btn-primary">Print Bill</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="card_cashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Card & Cash Payment</h1>
        
      </div>
      <div class="modal-body">
        <div class="mb-4">
            <label>Total Price *</label>
            <input type="text" class="form-control" id="totalPriceCardCash" readonly>
        </div>
        <div class="mb-4">
            <label>Cash paid Amount *</label>
            <input type="number" class="form-control" id="cashPIn" placeholder="Enter Cash Amount" min="0">
        </div>
        <div class="mb-4">
            <label>Card paid Amount *</label>
            <input type="text" class="form-control" id="cardIn" readonly>
        </div>
        <div class="mb-4">
            <label>Card No. (Last 4 Numbers) *</label>
            <input type="text" class="form-control" id="cardNoCardCash" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="cash_cardBtn">Print Bill</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Create Invoice (Walk-In Guest)
                <a href="r_index.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <!-- Guest Details Form -->
            <form id="customerForm">
                <div class="row">
                    <!-- NIC/Passport Number Dropdown -->
                     <div class="col-md-6 mb-2">
                    <label>NIC or Passport No *</label>
                    <select name="nic_pp" id="nic_pp" class="form-select js-mySelect2">
                        <option value="" readonly selected>Select Here</option>
                        <?php
                            $name = getAll('w_customers');
                            if ($name && mysqli_num_rows($name) > 0) {
                                foreach ($name as $nameItems) {
                                    echo '<option value="'.$nameItems['id'].'">'.$nameItems['nic_pp'].' - '.$nameItems['title'].' '.$nameItems['name'].'</option>';
                                }
                            } else {
                                echo '<option value="">No Customers Found</option>';
                            }
                        ?>
                    </select>
                </div>
                    <!-- Customer Details -->
                    <div class="col-md-1 mb-4">
                        <label for="id">Cus ID *</label>
                        <input type="text" id="id" class="form-control" readonly />
                    </div>
                    <div class="col-md-5 mb-4">
                        <label for="email">Email *</label>
                        <input type="text" id="email" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" id="name" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="bname">Billing Name *</label>
                        <input type="text" id="bname" class="form-control" readonly />
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" id="search" class="btn btn-outline-primary">Search &amp; Add</button>
                    </div>

                </div>
            </form>

               
        </div>
        
    </div>
     <!-- Additional Services -->
     <div class="card mt-2 shadow-sm">
                <div class="card_body px-3 mt-2">
                    <form id="additionalServicesForm">
                        <div class="row">
                            <div class="col-md-7 mb-4">
                                <label for="service">Service or Item Name *</label>
                                <input type="text" id="service" class="form-control" />
                            </div>
                            <div class="col-md-1 mb-4">
                                <label for="qty">Qty *</label>
                                <input type="number" id="qty"  value="1" class="form-control" min="1"/>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="servicePre">Ser. Charge *</label>
                                <input type="number" id="servicePre"  class="form-control" min="1"/>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="price">Charge or Price *</label>
                                <input type="number" id="price" class="form-control" />
                            </div>
                            <div class="col-md-12 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Add Service Button -->
                                    <button type="button" id="addService" class="btn btn-outline-primary">Add to Bill</button>
                                    
                                </div>
                            </div>




                            <div style="display: flex; align-items: center; gap: 60px;">
                                <!-- Checkbox -->
                                <div>
                                    <input type="checkbox" id="discount" name="discount" style="height: 25px; width: 25px; margin-right: 5px;" />
                                    <label for="discount">Any Discounts</label>
                                </div>

                               <!-- Discount Section -->
                                <div id="discount-section" style="display: none; align-items: center; gap: 15px;">
                                    <!-- Discount Value Input -->
                                    <div>
                                        <label for="disroom" style="margin-right: 5px;">Discount (Room) *</label>
                                        <input type="number" id="disroom" class="form-control" style="width: 150px;" min="0"/>
                                    </div>
                                    <div>
                                        <label for="dismeal" style="margin-right: 5px;">Discount (Meals) *</label>
                                        <input type="number" id="dismeal" class="form-control" style="width: 150px;" min="0"/>
                                    </div>
                                    <div>
                                        <label for="disSer" style="margin-right: 5px;">Discount (Ser. Charge) *</label>
                                        <input type="number" id="disSer" class="form-control" style="width: 150px;" min="0"/>
                                    </div>
                                   
                                </div>
                            </div>





                        </div>
                    </form>                


        <div class="table-responsive mb-4">
                   
            <table style="width:100%;" cellpadding="5">
                
                <thead>
                    <tr>
                    <th align="start" style="border-bottom: 1px solid #ccc;" width="4%">No</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;">Description</th> 
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="8%">Order ID</th>                            
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="8%">Room Charge</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="8%">Addit. Charge</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="8%">Ser. Charge</th>
                            <th align="center" style="border-bottom: 1px solid #ccc;"width="4%">Qty</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="10%">Total</th>                      
                    </tr>
                </thead>
                <tbody></tbody>
            </table>


        </div>


        <div class="row align-items-center">             
            <!-- Currency Calculator Button -->
            <div class="col-md-4 mb-4 ">
                <button type="button" id="calbtn" class="btn btn-secondary">Currency Calculator</button>
            </div>

                <!-- Dropdown for Payment Type -->
                <div class="col-md-4 mb-4 text-center">
                <select name="ptype" id="ptype" class="form-select" required>
                    <option value="" readonly selected>Select Payment Type</option>    
                    <option value="Card Payment">Card Payment</option>
                    <option value="Cash Payment">Cash Payment</option>                                                    
                    <option value="Card_Cash Payment">Card &amp; Cash Payment</option>  
                </select>
            </div>    

            <!-- Proceed to Payment Button -->
            <div class="col-md-4 mb-4 text-end">
                <button type="button" id="prospay" class="btn btn-warning">Proceed to Payment</button>
            </div>
        </div>
</div>        

<?php include('includes/footer.php'); ?>


<script src="../../admin/assets/js/custom.js"></script>

<!-- Your custom JavaScript -->
<script>
$(document).ready(function () {
    // Handle NIC/Passport dropdown change
    $('#nic_pp').on('change', function () {
        const customerId = $(this).val();
        
    });
});



</script>

<script src="../../admin/assets/js/search.js"></script>

<script>
    const cashierName = "<?php echo isset($_SESSION['loggedInUser']['name']) ? $_SESSION['loggedInUser']['name'] : 'N/A'; ?>";
</script>




</body>
</html>
