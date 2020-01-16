<?php 
    //  customQuery.php - jwitt 12/19/19
    //      recieves a user's text submission, sanitizes and formats 
    //      -> updates thee #main content or returns an excepton if query fails
    //      -> updates logged to console 
    session_start();
    if (!$rawQuery = $_POST['input']) die('error: cannot run an empty query'); 
    $conn = new mysqli(
        $_SESSION['host'],
        $_SESSION['username'],
        $_SESSION['password'],
        $_SESSION['database'],
        $_SESSION['port']); 

    // ensure connection 
    if ($conn->connect_errno) die('failed: '.$conn->connect_error); 
    if (!$conn->set_charset("utf8")) die('error: failed to load utf8: %s\n'.$conn->error);
    if (!$conn->autocommit(false)) die('autocommit not disabled');
    
    // connected w non-empty query, now cleanse input and query and fetch   
    $cleanQuery = trim($conn->real_escape_string($rawQuery)); 
    $flag = substr($cleanQuery,0,6); 
    $safeMode = $_POST['safe']; 
    $toPrepare = 'start tansaction; ?'.(($safeMode === 'true')? 'rollback;': 'commit;'); 
    echo $toPrepare; 
    echo $cleanQuery;
    $stmt = $conn->prepare($toPrepare); 
    $stmt->bind_param("s", $cleanQuery); 

        //error - calling on bool??
  
    //$stmt->execute(); 
    //$results = $stmt->get_result(); 
    //$stmt->close(); 

    // handle different query cases 
    if (strcasecmp($flag,'select') === 0) {
        //$toDisplay = []; 
        /*
        while ($row = $results->fetch_row()) {
            $toDisplay[] = $row; 
        }*/ 
        //var_export($toDisplay); 
        //if (!$results) die('error: '.$conn->error); 
        //echo $results->num_rows." result(s):"; 
        /*
        if ($results->num_rows > 0) {
                $fields = $results->fetch_fields(); 
                $limit = 0; 
                //echo '<table><tr>'; 
                foreach ($fields as $colName) {
                    //echo '<th>'.$colName.'</th>';    
                    $limit += 1; 
                }
                echo '</tr>'; 
                while ($row = $results->fetch_row()) {
                    echo '<tr>';
                    for ($i = 0; $i < $limit; $i++) {
                        echo '<td>'.$row[$i].'</td>'; 
                    }
                    echo '</tr>';
                } 
                echo '</table>';  
                echo 'test'; 
            } 

    */ 
    } else if (strcasecmp($flag,'insert') === 0) {
        echo '2';
    } else if (strcasecmp($flag,'delete') === 0) {
        //echo $conn->affected_rows.' row(s) affected'; 
        echo '3';
    } else { 
       echo '4'; 
    }   

    $conn->close();
?>