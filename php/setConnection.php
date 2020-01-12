<?php   
    // setConnection.php - jwitt 12/17/19
    //      checks client specified connection parameters
    //      -> logs result to the log widget
    session_start(); 
    $_SESSION['_username'] = $_POST['user'];
    $_SESSION['_password'] = $_POST['pass'];
    $_SESSION['_database'] = $_POST['db'];
    $_SESSION['_host'] = $_POST['host'];
    $_SESSION['_port'] = $_POST['port'];    

    echo 'trying '.
        $_SESSION['_username'].'@'.
        $_SESSION['_host'].':'.
        $_SESSION['_port'].' to '.
        $_SESSION['_database'].'...'; 
    $conn = new mysqli(
        $_SESSION['_host'],
        $_SESSION['_username'],
        $_SESSION['_password'],
        $_SESSION['_database'],
        $_SESSION['_port']);  
    // test connection 
    if ($conn->connect_errno)
        die('failed: '.$conn->connect_error); 
    // test charset 
    if (!$conn->set_charset("utf8")) 
        die('error: failed to load utf8: %s\n'.$conn->error);

    $conn->close(); 
    exit('success!'); 
?>