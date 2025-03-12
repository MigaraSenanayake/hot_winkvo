<?php 
require '../../config/function.php';
require '../authentication.php'; // Ensure authentication is properly set up and working.
?>

<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <title>WINKVO HMS Restaurant</title>

   <!-- CSS -->
  
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
   <link href="../../admin/assets/css/styles.css" rel="stylesheet" />
   <!-- <link href="../../admin/assets/css/btn_styles.css" rel="stylesheet" /> -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
   <link href="../../assets/styles.css" rel="stylesheet" />

<style>
   .select2-container .select2-selection--single {
      height: 36px !important; /* Match height with input fields */
      display: flex; /* Use flexbox for alignment */
      align-items: center; /* Center content vertically */
   }
   .select2-container--default .select2-selection--single .select2-selection--rendered {
      line-height: normal !important; /* Reset line height for text */
      padding: 0 8px !important; /* Add padding for text spacing */
      font-size: 16px; /* Adjust font size */
      color: #212529; /* Match text color with Bootstrap inputs */
   }
   .select2-container--default .select2-selection--single .select2-selection--arrow {
      height: 100% !important; /* Stretch arrow container height */
      width: 36px; /* Make arrow container square */
      display: flex; /* Use flexbox */
      justify-content: center; /* Horizontally center arrow */
      align-items: center; /* Vertically center arrow */
      background-color: #f8f9fa; /* Optional: Match Bootstrap background color */
      border-left: 1px solid #ced4da; /* Optional: Add border to match input style */
      border-radius: 0 0.25rem 0.25rem 0; /* Match Bootstrap's rounded corners */
   }
   .select2-container--default .select2-selection--single .select2-selection--arrow b {
      border-color: #6c757d transparent transparent transparent; /* Set arrow color */
      border-width: 7px 5px 0 6px; /* Arrow size */
   }
</style>

</head>

<body class="sb-nav-fixed">

   <?php include('navibar.php'); ?>

   <div id="layoutSidenav">

      <?php include('sidebar.php'); ?>

      <div id="layoutSidenav_content">

         <main>
            <!-- Display any session message if present -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); // Clear message after displaying
                    ?>
                </div>
            <?php endif; ?>

            <!-- Main content goes here -->
