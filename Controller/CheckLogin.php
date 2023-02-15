<?php
function getUserCredentials() {
    $serverName = "sbss.database.windows.net";
    $connectionOptions = array(
      "Database" => "sbsdb",
      "UID" => "phpdbLogin",
      "PWD" => "php-Password123"
    );
  
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
      die("Connection failed: " . sqlsrv_errors());
    }
  
    $sql = "SELECT userEmail, userPW FROM Users";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
      die("Query failed: " . sqlsrv_errors());
    }
  
    $results = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      $results[] = $row;
    }
  
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
  
    return $results;
  }
  


?>