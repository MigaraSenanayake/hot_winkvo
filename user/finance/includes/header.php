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
   <title>WINKVO HMS Kitchen</title>
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
   <link href="../../admin/assets/css/styles.css" rel="stylesheet" />
   <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
