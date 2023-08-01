
<?include ('header.php')?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>
    <?php echo $page = substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],"/")+1);?>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a class="nav-link <?= $page == 'home.php' ? 'active':'' ?>" href="home.php">
              <i class="nav-icon fas fa-home fa-fade"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link <?= $page == 'bank.php' ||$page == 'all_bank.php' ? 'active':'' ?>" href="bank.php">
            <i class="nav-icon fas fa-university"></i>
              <p>Banking</p>
            </a>
          </li>
           
              <p>Sales
              
            <!-- <ul class="nav nav-treeview"> -->
              <li class="nav-item">
                <a class="nav-link <?= $page == 'company.php' || $page == 'all_company.php' ? 'active':'' ?>" href="company.php">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $page == 'client_information.php' || $page == 'client_info.php' ? 'active':'' ?>"  href="client_information.php">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $page == 'websites.php' || $page == 'all_website.php' ? 'active':'' ?>" href="websites.php">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="invoice_list.php"
                class="nav-link <?= $page == 'invoice_list.php' || $page == 'create_invoice.php' ? 'active':'' ?>" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="qout_list.php"
                class="nav-link <?= $page == 'qout_list.php' || $page == 'create_qout.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quotation</p>
                </a>
              </li>
            <!-- </ul> -->
            </p>
              <p>Purchase
              
            </a>
              <li class="nav-item">
                <a href="vendor_list.php" class="nav-link <?= $page == 'vendor_list.php' || $page == 'create_vendor.php'? 'active':'' ?>">
                  <i class="far fa-building nav-icon"></i>
                  <p>Vendor</p>
                </a>
              </li>
              </p>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>