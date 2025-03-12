<?php include('includes/header.php'); 


$billNumber = "INV" . str_pad(rand(0, 99999), 5, "0", STR_PAD_LEFT);


?>

<div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Card Payment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>      
      <div class="modal-body">      
        
        <div class="mb-4">
            <label>Enter Card No. *</label> 
            <input type="text" class="form-control" id="cardNo">           
        </div>
        <div class="mb-4">
            <label>Exp. Date *</label> 
            <input type="date" class="form-control" id="exdDate">           
        </div>  
        <div class="mb-4">
            <label>CRC *</label> 
            <input type="text" class="form-control" id="crc">           
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
            <label>Total Price *</label> 
            <input type="text" class="form-control" id="totalPrice" readonly>           
        </div> 
        <div class="mb-4">
            <label>Cash *</label> 
            <input type="number" class="form-control" id="cashInput" placeholder="Enter Cash Amount">           
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


<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Create Invoice (In-House Guest)
                <a href="r_index.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <!-- Guest Details Form -->
            <form id="customerForm">
                <div class="row">
                <div class="col-md-8 mb-2 ">
                        <label>NIC or Passport No *</label>
                        <select name="nic" id="nic" class="form-select js-mySelect2">
                            <option value="" disabled selected>Select Here</option>
                            <?php
                                $name = mysqli_query($conn, "SELECT * FROM bcustomers WHERE departure > CURDATE()");
                                if ($name && mysqli_num_rows($name) > 0) {
                                    foreach ($name as $cusData) {
                                        echo '<option value="'.$cusData['id'].'">'.$cusData['nic_pp'].' -  '.$cusData['title'].' '.$cusData['fname'].' '.$cusData['lname'].'</option>';
                                    }
                                } else {
                                    echo '<option value="">No Customers Found</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="id">Customer ID *</label>
                        <input type="text" id="id" class="form-control" disabled />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" id="name" class="form-control" disabled />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="bname">Billing Name *</label>
                        <input type="text" id="bname" class="form-control" disabled />
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" id="search2" class="btn btn-outline-primary">Search &amp; Add</button>
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
                    <div class="col-md-6 mb-4">
                        <label for="service">Service or Item Name *</label>
                        <input type="text" id="service" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="qty">Quantity *</label>
                        <input type="number" id="qty" value="1" class="form-control" min="1" />
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="price">Charge or Price (LKR) *</label>
                        <input type="number" id="price" class="form-control" />
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" id="addService" class="btn btn-outline-primary">Add to Bill</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive mb-4">
            <table style="width:100%;" cellpadding="5">
                    <thead>
                        <tr>
                            <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">No</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;">Description</th>                            
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="10%">Order ID</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="10%">Price</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="10%">Quantity</th>
                            <th align="start" style="border-bottom: 1px solid #ccc;"width="15%">Total</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            

            </div>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4">
                    
                    <select name="ptype" id="ptype" class="form-select" required>
                        <option value="" disabled selected>Select Payment Type</option>    
                        <option value="Card Payment">Card Payment</option>
                        <option value="Cash Payment">Cash Payment</option>                                                    
                    </select>
                </div>     

                <div class="col-md-6 text-end mb-4">
                    <button type="button" id="prospay" class="btn btn-outline-warning mt-4">Proceed to Payment</button>
                </div>
            </div>


            
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
