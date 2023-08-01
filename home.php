<?php 
session_start();
require('header.php');
require('sidebar.php');
require('connection.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <!-- progress bar start -->

                    <!-- <div class="row text-white mb-3">
                        <div class="col-sm-5">
                          <h5 class="mt-3">Html/css</h5>                          
                          <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100%</div>
                          </div>
                        </div>
                        <div class="col-sm-5 offset-sm-2">
                          <h5 class="mt-3">javascript</h5>                          
                          <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">95%</div>
                          </div>
                        </div> -->
                    <?php
// Start the PHP session (place this at the top of your PHP script)
// If the website ID is stored in the session, use it to handle website expiry

        // Fetch the website information from the database based on the website ID
        $query = mysqli_query($con,"select * from website");
        
        // $id = $_GET["website_id"];
        while($row=mysqli_fetch_assoc($query)){
        
        // domain_ details
        $id = $row['id'];
        $domain_name = $row['domain_name'];
        $domain_startDate = new DateTime($row['domain_from']);
        $domain_endDate = new DateTime($row['domain_to']);
        $domain_dateDifference = $domain_startDate->diff($domain_endDate);
        $domain_days = $domain_dateDifference->d;
        
        $domain_currentDate = new DateTime();
        $domain_interval = $domain_currentDate->diff($domain_endDate);
        $domain_remainingDays = $domain_interval->format('%a');
        $percent = ($domain_remainingDays/90)*100;

        
        // echo $domain_name." is remaining ".$domain_remainingDays." Days";
        if ($domain_remainingDays <= 90 && $domain_remainingDays >=46) {
          echo '<div class="progress">
          <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$domain_remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">'.$domain_remainingDays.' Days</div>
          </div>';
          echo "Your domain <a href='edit_website.php?id=$id'>$domain_name</a> will expire in $domain_remainingDays days. Please renew soon.";
              echo "<br>";
        }elseif($domain_remainingDays <= 45 && $domain_remainingDays >=31){
          echo '<div class="progress">
          <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$domain_remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">'.$domain_remainingDays.' Days</div>
          </div>';
            echo "Your domain <a href='edit_website.php?id=$id'>$domain_name</a> will expire in $domain_remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($domain_remainingDays <= 30) {
          echo '<div class="progress">
          <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$domain_remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">'.$domain_remainingDays.' Days</div>
          </div>';
            echo "Your  domain <a href='edit_website.php?id=$id'>$domain_name</a> will expire in $domain_remainingDays days. Please renew soon.";
            
            echo "<br>";
        }elseif ($domain_remainingDays === 0) {
            echo "Your domain <a href='edit_website.php?id=$id'>$domain_name</a> will expire today. Please renew immediately.";
            echo "<br>";
        } elseif ($domain_remainingDays < 0) {
            echo "Your domain <a href='edit_website.php?id=$id'>$domain_name</a> has expired. Please renew to continue using the application.";
            echo "<br>";
        }
        // echo "<br>";

        // hosting_ details
        $hosting_username = $row['hosting_username'];
        $hosting_startDate = new DateTime($row['hosting_from']);
        $hosting_endDate = new DateTime($row['hosting_to']);
        $hosting_dateDifference = $hosting_startDate->diff($hosting_endDate);

        // Calculate the remaining days until the website expires
        $currentDate = new DateTime();
        $interval = $currentDate->diff($hosting_endDate);
        $remainingDays = $interval->format('%a');
        $per_days = ($remainingDays/90)*100;
        // echo $hosting_username." is remaining ".$remainingDays." Days";
        if ($remainingDays <= 90 && $domain_remainingDays >=46) {
          echo '<div class="progress">
          <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$per_days.'%">'.$remainingDays.' Days</div>
          </div>';
            echo "Your hosting <a href='edit_website.php?id=$id'>$hosting_username</a> will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif($remainingDays <= 45 && $domain_remainingDays >=31){
          echo '<div class="progress">
          <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$per_days.'%">'.$remainingDays.' Days</div>
          </div>';
            echo "Your hosting <a href='edit_website.php?id=$id'>$hosting_username</a> will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($remainingDays <= 30) {
          echo '<div class="progress">
          <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="'.$remainingDays.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$per_days.'%">'.$remainingDays.' Days</div>
          </div>';
            echo "Your hosting <a href='edit_website.php?id=$id'>$hosting_username</a> will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($remainingDays === 0) {
            echo "Your hosting <a href='edit_website.php?id=$id'>$hosting_username</a> will expire today. Please renew immediately.";
            echo "<br>";
        } elseif ($remainingDays < 0) {
            echo "Your hosting <a href='edit_website.php?id=$id'>$hosting_username</a> has expired. Please renew to continue using the application.";
            echo "<br>";
        }
        // Display messages when nearing expiration
        
        
        ?>
        <?php } ?>
   
                            </p>




                    <!-- progress bar end -->
                    
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('footer.php')?>