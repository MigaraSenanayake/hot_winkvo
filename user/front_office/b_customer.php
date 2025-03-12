<?php include('includes/header.php'); ?>

<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.css" />

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">In-House Guests
                <a href="b_cus_create.php" class="btn btn-outline-success float-end">Register</a>
                
            </h4>
        </div>
        <div class="card-body px-3 mt-3">
            <?php alertMessage(); ?>

            <?php
            // Fetch all records from the 'bcustomers' table
            $b_cust = getAll('bcustomers');
            if ($b_cust === false) { 
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($b_cust) > 0) {
            ?>
                <!-- Top Scrollbar Container -->
                <div id="top-scroll" class="overflow-auto mb-2" style="overflow-x: auto;">
                    <div style="width: max-content;"></div>
                </div>

                <!-- Search Bar with Icon -->
                <div class="col-md-6 mb-4 position-relative">
                    <input type="text" id="searchNIC" class="form-control pr-5" placeholder="Type NIC/Passport to check if already registered..." onkeyup="filterbyNIC()" />
                    <i class="fas fa-search position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                </div>

                

                <!-- Table Scrollable Container -->
                <div id="table-scroll" class="table-responsive overflow-auto" style="max-height: 320px; overflow-x: auto;">
                    <table class="table table-striped table-bordered" style="width: max-content;" id="bcusTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Billing Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>NIC/Passport No.</th>
                                <th>Address</th>
                                <th>Num of Rooms</th>
                                <th>Room No</th>
                                <th>Room Pack</th> 
                                <th>Arrival Date</th>
                                <th>Departure Date</th>       
                                <th>Booking from</th>
                                <th>NIC or Passport</th>
                                <th>Image of Visa Page</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($b_cust as $b_custItem) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($b_custItem['id']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['title']) . ' ' . htmlspecialchars($b_custItem['fname']) . ' ' . htmlspecialchars($b_custItem['lname']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['bname']);?></td>
                                    <td><?= htmlspecialchars($b_custItem['phone']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['email']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['nic_pp']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['address']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['r_num']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['room']); ?></td>                                   
                                    <td><?= htmlspecialchars($b_custItem['room_pack']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['arrival']); ?></td>
                                    <td><?= htmlspecialchars($b_custItem['departure']); ?></td>                                 
                                    <td><?= htmlspecialchars($b_custItem['booking']); ?></td>
                                    <td>
                                        <?php
                                        // Check if a valid photo exists and provide a clickable link with Fancybox
                                        if (!empty($b_custItem['photo']) && file_exists('../uploads/' . $b_custItem['photo'])) {
                                            // Fancybox image link with thumbnail
                                            echo '<a href="../uploads/' . htmlspecialchars($b_custItem['photo']) . '" data-fancybox="gallery" data-caption="NIC or Passport Image">';
                                            echo '<img src="../uploads/' . htmlspecialchars($b_custItem['photo']) . '" alt="NIC/Passport" style="width: 50px; height: 50px;">';
                                            echo '</a>';
                                        } else {
                                            echo 'No Image';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        // Check if a valid photo exists and provide a clickable link with Fancybox
                                        if (!empty($b_custItem['visa_photo']) && file_exists('../uploads/' . $b_custItem['visa_photo'])) {
                                            // Fancybox image link with thumbnail
                                            echo '<a href="../uploads/' . htmlspecialchars($b_custItem['visa_photo']) . '" data-fancybox="gallery" data-caption="Image of Visa Page">';
                                            echo '<img src="../uploads/' . htmlspecialchars($b_custItem['visa_photo']) . '" alt="Image of Visa Page" style="width: 50px; height: 50px;">';
                                            echo '</a>';
                                        } else {
                                            echo 'No Image';
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <a href="b_cus_edit.php?id=<?= htmlspecialchars($b_custItem['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
                                        <a href="b_cus_reCreate.php?id=<?= htmlspecialchars($b_custItem['id']); ?>" class="btn btn-outline-success btn-sm">Re-register</a>
                                    </td>                                  

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
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

<?php include('includes/footer.php'); ?>

<!-- Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.umd.js"></script>


<script src="../../admin/assets/js/filter.js"></script>


<script>
    // Sync scrolling between top-scroll and table-scroll
    var topScroll = document.getElementById('top-scroll');
    var tableScroll = document.getElementById('table-scroll');

    topScroll.onscroll = function() {
        tableScroll.scrollLeft = topScroll.scrollLeft;
    };

    tableScroll.onscroll = function() {
        topScroll.scrollLeft = tableScroll.scrollLeft;
    };
</script>
