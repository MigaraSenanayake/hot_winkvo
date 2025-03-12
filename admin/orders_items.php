<?php include('includes/header.php'); 
require_once('../config/function.php');

?>


<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Total Selled Items
            <a href="javascript:void(0);" class="btn btn-warning float-end" onclick="printFilteredTable()">Print</a>
            <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>               
            </h4>
        </div>
        <div class="card-body px-3 mt-3">
            <?php alertMessage(); ?>

            <?php
            // Ensure $conn is defined before calling this function
            function getMenuItemsWithTotalOrders() {
                global $conn; // Ensure database connection is available
                $query = "
                    SELECT 
                        m.id AS item_id,
                        m.name AS item_name,
                        IFNULL(SUM(oi.quantity), 0) AS order_qty, -- Update the column name here
                        IFNULL(SUM(woi.quantity), 0) AS w_order_qty,   -- Check if w_order_items also uses 'quantity'
                        (IFNULL(SUM(oi.quantity), 0) + IFNULL(SUM(woi.quantity), 0)) AS total_qty
                    FROM 
                        menu m
                    LEFT JOIN 
                        order_items oi ON m.id = oi.item_id
                    LEFT JOIN 
                        w_order_items woi ON m.id = woi.item_id
                    GROUP BY 
                        m.id, m.name
                    ORDER BY 
                        total_qty DESC;
                ";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Query Error: " . mysqli_error($conn));
                }
                return $result;
            }
            

            // Fetch the menu items
            $menuItems = getMenuItemsWithTotalOrders();
            if ($menuItems === false) { 
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($menuItems) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Orders Qty</th>
                                <th>Walk-In Orders Qty</th>
                                <th>Total Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grandTotal = 0;
                            while ($row = mysqli_fetch_assoc($menuItems)) : 
                                $grandTotal += $row['total_qty'];
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['item_id']); ?></td>
                                    <td><?= htmlspecialchars($row['item_name']); ?></td>
                                    <td><?= htmlspecialchars($row['order_qty']); ?></td>
                                    <td><?= htmlspecialchars($row['w_order_qty']); ?></td>
                                    <td><?= htmlspecialchars($row['total_qty']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="4"><strong>Grand Total Items Ordered:</strong></td>
                                <td><strong><?= htmlspecialchars($grandTotal); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<h4 class="mb-0">No Records Found</h4>';
            }
            ?>

        </div>
    </div>
</div>
<!-- <script src="../../admin/assets/js/filter.js"> -->

<script>

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
