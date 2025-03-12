<?php 
function getAllWithCondition($table, $condition) {
    global $conn; // Use your database connection
    $query = "SELECT * FROM $table WHERE $condition";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn)); // Debugging help
    }

    return $result;
}
include('includes/header.php'); 
?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Payments (In-House)
            <a href="javascript:void(0);" class="btn btn-warning float-end" onclick="printFilteredTable()">Print</a>

                <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>               
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $payments = getAllWithCondition('payments', "status = 'Success'");
            if ($payments === false) { // Check if fetching payments failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($payments) > 0) {
            ?>


                <!-- Search Bar with Icon -->
                <div class="col-md-6 mb-4 position-relative">
                    <input type="month" id="searchmonthYear" class="form-control pr-5" placeholder="Type Year &amp; Month" onchange="filterbymonthYear()" />
                    
                </div>


                
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 330px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" style="width: max-content;" id="paymentTb">
                   
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cus ID</th>
                                <th>Order IDs</th>
                                <th>Bill Total</th>
                                <th>Ser. Charge</th>
                                <th>payment Type</th>                                
                                <th>Card No</th>                                
                                <th>Payment Date</th>
                                <th>Booking</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $paymentItem) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($paymentItem['id']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['customer_id']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['order_ids']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['bill_total']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['service_charge']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['payment_method']); ?></td>
                                    <td><?= htmlspecialchars($paymentItem['card_number']); ?></td>                                    
                                    <td><?= htmlspecialchars($paymentItem['payment_date']); ?></td>  
                                    <td><?= htmlspecialchars($paymentItem['booking']); ?></td>                                                                                                           
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>Total:</strong></td>
                                <td id="billTotalSum">0.00</td>
                                <td id="serviceChargeSum">0.00</td>
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
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
<script src="../admin/assets/js/filter.js"></script>
<script>

    function calculateTotals() {
    const table = document.getElementById("paymentTb");
    const rows = table.getElementsByTagName("tr");
    let billTotal = 0;
    let serviceChargeTotal = 0;

    // Loop through visible rows only (skipping the header and footer)
    for (let i = 1; i < rows.length - 1; i++) {
        if (rows[i].style.display !== "none") {
            const cols = rows[i].getElementsByTagName("td");
            const bill = parseFloat(cols[3]?.textContent || 0);
            const serviceCharge = parseFloat(cols[4]?.textContent || 0);
            billTotal += bill;
            serviceChargeTotal += serviceCharge;
        }
    }

    // Update totals in the footer
    document.getElementById("billTotalSum").textContent = billTotal.toFixed(2);
    document.getElementById("serviceChargeSum").textContent = serviceChargeTotal.toFixed(2);
    }

    function printFilteredTable() {
    const table = document.getElementById("paymentTb");
    const clonedTable = table.cloneNode(true);

    // Remove hidden rows (those filtered out)
    const rows = clonedTable.getElementsByTagName("tr");
    for (let i = rows.length - 1; i >= 1; i--) { // Start from 1 to skip the header
        if (rows[i].style.display === "none") {
            rows[i].remove();
        }
    }

    // Create a new window for printing
    const printWindow = window.open("", "", "width=800,height=600");
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Payments Table (In-House)</title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    table, th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                        @media print {
                        body {
                            width: 210mm; /* A4 paper width */
                            height: 297mm; /* A4 paper height */
                            margin: 0;
                            padding: 20mm;
                        }
                        
                        
                        @page { margin: 0; }
                </style>
            </head>
            <body>
                <h3>Payments Table (In-House)</h3>
                ${clonedTable.outerHTML}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
<?php include('includes/footer.php'); ?>
