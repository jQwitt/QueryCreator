<?php 
    //  getQuery.php - jwitt 11/24/19
    //      recieves a sanitized query and returns the results 
    //      to the client     
    session_start(); 
    if (!$_SESSION['c_connection']->ping()) 
        throw new Exception('connection interrupted');
?>