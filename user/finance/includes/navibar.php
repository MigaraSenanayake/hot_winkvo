<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-4"><img src="../../pic/logo.png" width="110" height="65" style="margin-left: 25px;" ></a>
  <!-- Sidebar Toggle-->
   
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

  <!-- Navbar Search-->

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-4 my-2 my-md-0">
    
   
    <!-- <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div> -->


  </form> 

  <!-- Navbar-->

  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    
    <li class="nav-item">
      <a class="nav-link active"  style="margin-right: 30px;">Hello Finance Officer <?= $_SESSION['loggedInUser']['name']; ?></a>
    </li>

  
 
    </li>
  </ul>
</nav>