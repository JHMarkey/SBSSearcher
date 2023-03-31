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
      die(print_r(sqlsrv_errors()));
    }
    return $conn; // Returning the established database connection
  }
  $ID = 0;
  $conn = connect();
  $sel = 1;
  $userID = 5;
  $sql="SELECT IconID FROM UserIcon Where UserID = ? and selected = 1";
  $params=array($userID, $sel);
  $stmt = sqlsrv_query($conn,$sql,$params);

  if($stmt === false){
    die(print_r(sqlsrv_errors()));
  } else{
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if(!empty($row)){
        $ID= $row['IconID'];
    }
  }

  $sql="SELECT IconFile FROM Icons Where IconID = ?";
  $params=array($ID);
  $stmt = sqlsrv_query($conn,$sql,$params);

  if($stmt === false){
    die(print_r(sqlsrv_errors()));
  } else{
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if(!empty($row)){
        $file= $row['IconFile'];
    }
  }
?>
<body>
<div id="counter" style="font-size:75px">0</div>
    <div id="game-container" style="padding-left:25%;">
        
            <div>
                <img id="game-image-left" src="../Assets/Icons/dracula.png" alt="Your Character" style="height: 40%; width: 40%;">
            </div>
            <div>
                <div id="gameprogress-bar">
                    <div id="gameprogress-bar-fill" style="width: 0%;"></div>
                </div>
        
                <img id="game-image" src="../Assets/Icons/monster.png" alt="Monster" style="height: 40%; width: 40%;">
            </div>
    </div>
    <script src="../View/scripts/game.js"></script>
</body>
</html>
