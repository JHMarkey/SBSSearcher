<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");

function connect(){
  $serverName = "sbss.database.windows.net"; // Server name
  $connectionOptions = array(
    "Database" => "sbsdb", // Database name
    "UID" => "phpdbLogin", // Database login user ID
    "PWD" => "php-Password123" // Database login password
  );
  $conn = sqlsrv_connect($serverName, $connectionOptions); // Establishing the database connection
  
  // Checking the database connection status and throwing an error message if the connection failed
  if (!$conn) {
    die("Connection failed: " . sqlsrv_errors());
  }
  return $conn; // Returning the established database connection
}
?>

<div class="container">
  <h1>Select an Icon:</h1>
<form>
<?php

$conn = connect();

session_start();
        $fn = $_SESSION['FN'];
        $sn = $_SESSION['SN'];
        $sql = "SELECT UserID FROM Users WHERE UserFN = ? AND UserSN = ?";
        $params = array($fn, $sn);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
          die(print_r(sqlsrv_errors()));
        }
        
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if(!empty($row)){
          $userID = $row['UserID'];
        }else{
          echo("Currently No Available Icons, Complete Courses to unlock");
        }
// Query the UserIcon table to get all unlocked icons for the current user
$sql = "SELECT IconID FROM UserIcon WHERE UserID = ?";
$params = array($userID);
$idstmt = sqlsrv_query($conn, $sql, $params);

while($row = sqlsrv_fetch_array($idstmt, SQLSRV_FETCH_ASSOC)){
   
  $iconID = $row['IconID'];
  $sql = "SELECT IconFile FROM Icons WHERE IconID = ?";
  $params = array($iconID);
  $stmt = sqlsrv_query($conn, $sql, $params);

  if(empty($row)){
    echo("Currently No Available Icons, Complete Courses to unlock");
  }else{
  
    $sql = "SELECT IconFile FROM Icons WHERE IconID = ?";
    $params = array($iconID);
    $stmt = sqlsrv_query($conn, $sql, $params);
  
    // Create a radio box with the unlocked icons
    echo "<form>";
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $file = $row['IconFile'];
        
        echo "<input type='radio' name='icon' id='icon' value='$iconID'><img src='../Assets/Icons/$file'><br>";
    }
    echo "</form>";
  }
  
}

// Clean up
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

</form>

</div>

<script src="../View/scripts/Profile.js"></script>