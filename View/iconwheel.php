<?php
session_start();
require("../View/_inc/avatarhead.php");
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
  
  $conn = connect();                                                
  $fn = $_SESSION['FN'];
  $sn = $_SESSION['SN'];
  $e = $_SESSION['E'];
  $sql = "SELECT UserID FROM Users WHERE UserFN = ? AND UserSN = ? AND UserEmail = ?";
  $params = array($fn, $sn, $e);
  $stmt = sqlsrv_query($conn, $sql, $params);
  
  if ($stmt === false) {
	die(print_r(sqlsrv_errors()));
  }
  
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  if(!empty($row)){
	$userID = $row['UserID'];
  
	// Query the UserIcon table to get all unlocked icons for the current user
	$sql = "SELECT IconID FROM UserIcon WHERE UserID = ?";
	$params = array($userID);
	$idstmt = sqlsrv_query($conn, $sql, $params); 
	
  }else{
	$name = "Currently No Available Icons, Complete Courses to unlock some";
  }

?>

<div class="unboxing-container">
		<h1>Get Your New Icon</h1>
		<button onclick="unbox()">Unbox</button>
		<div id="unboxing-area">
	        <p>Click the button to unbox an icon</p>
	        <div id="item-cycle" ></div>
	        <div id="final-item" ></div>
        </div>
		<div id="user-history">
			<h2>Your Unboxing History</h2>
			<?php



				while($row = sqlsrv_fetch_array($idstmt, SQLSRV_FETCH_ASSOC)){    
					$iconID = $row['IconID'];
					$sql = "SELECT IconFile FROM Icons WHERE IconID = ?";
					$params = array($iconID);
					$stmt = sqlsrv_query($conn, $sql, $params);
					$name= "";
					if(empty($row)){
					  $name = "Currently No Available Icons, Complete Courses to unlock some";
					}else{            
					  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
						$file = $row['IconFile'];                                                        
					  }       
					}    
					echo "<img src='../Assets/Icons/$file' alt=$name>";
					}  
			?>
		</div>
	</div>