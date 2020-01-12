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
    $stmt = $conn->prepare('start tansaction;'.$cleanQuery.(($safeMode === 'true')? 'rollback;': 'commit;')); 
    
    // TO DO KAJDKJBWDA:WBD
    //https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
    
    // handle different query cases 
    if (strcasecmp($flag,'select') === 0) {
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
    // automatic at eof but clean up for learning purposes 
    //$results->free();
    $conn->close();

        /*
        
           
        if (!$results) {
            echo '<p class="red space-below">Query failed</p>'; 
        }
        if ($results->num_rows > 0) {
            echo $results->num_rows." result(s):";  
            //echo "<table class='space-below'><tr><th>ID</th><th>Name</th><th>Date</td></tr>"; 
            echo "<table class='space-below'><tr><th>ID</th></tr>";
            while($row = $results->fetch_row()) {
                //echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                echo "<tr><td>".$row[0]."</td></tr>"; 
            } 
            echo "</table>";  
        */
?>