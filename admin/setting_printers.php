<?php 
include('includes/header.php'); 

?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Printer Settings
                <a href="index.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body px-3 mt-2">
            <?php
            // include("../config/function.php");

            // Fetch the selected printer from the database
            $sql = "SELECT printer_name FROM admin_settings WHERE setting_key = 'printer'";
            $result = mysqli_query($conn, $sql);
            $adminSettings = mysqli_fetch_assoc($result);

            // Get the list of available printers from the system
            $printers = [];
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $output = shell_exec('wmic printer get name');
                if ($output) {
                    $printers = explode("\n", trim($output));
                    array_shift($printers); // Remove the first line which is "Name"
                    $printers = array_map('trim', $printers);
                }
            }

            // If form is submitted, update the printer setting
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kot_printer_name'])) {
                $printerName = validate($_POST['kot_printer_name']);
                $updateSQL = "UPDATE admin_settings SET printer_name = '$printerName' WHERE setting_key = 'printer'";
                if (mysqli_query($conn, $updateSQL)) {
                    echo '<div class="alert alert-success">Printer updated successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Error updating printer: ' . mysqli_error($conn) . '</div>';
                }
            }
            ?>

            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="printer_name">Select KOT Printer *</label>
                        <select name="kot_printer_name" id="kot_printer_name" class="form-select" required>
                          <option value=""disabled selected>Select a Printer</option>
                            <?php
                            if (!empty($printers)) {
                                foreach ($printers as $printer) {
                                    $selected = ($adminSettings['printer_name'] == $printer) ? 'selected' : '';
                                    echo "<option value=\"$printer\" $selected>$printer</option>";
                                }
                            } else {
                                echo '<option value="">No printers available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="printer_name">Select Invoice Printer *</label>
                        <select name="invoice_printer_name" id="invoice_printer_name" class="form-select" required>
                            <option value=""disabled selected>Select a Printer</option>
                            <?php
                            if (!empty($printers)) {
                                foreach ($printers as $printer) {
                                    $selected = ($adminSettings['printer_name'] == $printer) ? 'selected' : '';
                                    echo "<option value=\"$printer\" $selected>$printer</option>";
                                }
                            } else {
                                echo '<option value="">No printers available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
