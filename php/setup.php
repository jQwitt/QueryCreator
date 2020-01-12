<?php 
    // setup.php - jwitt 11/24/19
    //      handles all session data and cookie setup
    //      inits database variables 
    session_start(); 
    date_default_timezone_set('America/Los_Angeles'); 
    $_SESSION['date'] = date("Y/m/d - h:i:s A"); 
?>