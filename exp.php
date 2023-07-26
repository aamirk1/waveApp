<?php
// Start the PHP session (place this at the top of your PHP script)
session_start();
include('connection.php');
// If the website ID is stored in the session, use it to handle website expiry

        // Fetch the website information from the database based on the website ID
        $query = mysqli_query($con,"select * from website");
        
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
            echo "Your domain $domain_name will expire in $domain_remainingDays days. Please renew soon.";
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
   