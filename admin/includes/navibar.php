<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-4"><img src="../pic/logo.png" width="110" height="65" style="margin-left: 25px;" ></a>
  <!-- Sidebar Toggle-->
   
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>


  <!-- Navbar-->

  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    
    <li class="nav-item">
      <a class="nav-link active" style="margin-right: 30px;">Welcome System Admin <?= $_SESSION['loggedInUser']['name']; ?></a>
    </li>

  
  </ul>
</nav>