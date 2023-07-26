<?php 

session_start();
    include ('header.php');
    include ('sidebar.php');
    include ('connection.php');

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

	<section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            
                <div class="col-md-12">
                    <div class="card mt-2">
                    
                        <!-- /.card-header -->
                    
                        <div class="alert alert-danger alert-dismissible fade show mt-2 mb-3 w-50 text-end" style="margin-left: 25%;background-color: #ff5050d4;border-color: #ff6b6b;"role="alert">
                            <div class="card-body table-responsive p-0">
                            <p class="text-center">
                            <?php
// Start the PHP session (place this at the top of your PHP script)
// If the website ID is stored in the session, use it to handle website expiry

        // Fetch the website information from the database based on the website ID
        $query = mysqli_query($con,"select * from website");
        
        // $id = $_GET["website_id"];
        while($row=mysqli_fetch_assoc($query)){
        
        // domain_ details
        $domain_name = $row['domain_name'];
        $domain_startDate = new DateTime($row['domain_from']);
        $domain_endDate = new DateTime($row['domain_to']);
        $domain_dateDifference = $domain_startDate->diff($domain_endDate);
        $domain_days = $domain_dateDifference->d;
        
        $domain_currentDate = new DateTime();
        $domain_interval = $domain_currentDate->diff($domain_endDate);
        $domain_remainingDays = $domain_interval->format('%a');
        // echo $domain_name." is remaining ".$domain_remainingDays." Days";
        if ($domain_remainingDays <= 90) {
            echo "Your domain <a href='#'>$domain_name</a> will expire in $domain_remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif($domain_remainingDays <= 45){
            echo "Your domain $domain_name will expire in $domain_remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($domain_remainingDays <= 30) {
            echo "Your domain $domain_name will expire in $domain_remainingDays days. Please renew soon.";
            
            echo "<br>";
        }elseif ($domain_remainingDays === 0) {
            echo "Your domain $domain_name will expire today. Please renew immediately.";
            echo "<br>";
        } elseif ($domain_remainingDays < 0) {
            echo "Your domain $domain_name has expired. Please renew to continue using the application.";
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
        // echo $hosting_username." is remaining ".$remainingDays." Days";
        if ($remainingDays <= 90) {
            echo "Your hosting $hosting_username will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif($remainingDays <= 45){
            echo "Your hosting $hosting_username will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($remainingDays <= 30) {
            echo "Your hosting $hosting_username will expire in $remainingDays days. Please renew soon.";
            echo "<br>";
        }elseif ($remainingDays === 0) {
            echo "Your hosting $hosting_username will expire today. Please renew immediately.";
            echo "<br>";
        } elseif ($remainingDays < 0) {
            echo "Your hosting $hosting_username has expired. Please renew to continue using the application.";
            echo "<br>";
        }
        // Display messages when nearing expiration
        
        
        ?>
        <?php } ?>
   
                            </p>
                        </div>
                        <a href="home.php" class="close text-white" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                        <!-- <a type="button" href="home.php" class="close text-white" data-dismiss="alert" aria-label="Close"> -->
                            <!-- <span aria-hidden="true">&times;</span> -->
                        <!-- </a> -->
</div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->
    </section>

</div>
<?php include('footer.php')?>