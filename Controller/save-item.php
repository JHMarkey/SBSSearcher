<?php
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
  
	// retrieve the item data from the AJAX request
	$itemData = json_decode(file_get_contents("php://input"), true);
    if($itemData == null){
        echo("No Item");
    }

    print_r($itemData);
	
	$conn = connect();
	
	if ($conn === false) {
		// code to execute if the connection to the database fails
		die(print_r(sqlsrv_errors(), true));
	} else {
		$iconID = null;
        $tsql = "SELECT IconID FROM Icons WHERE IconName = ?";
        $params = array($itemData[0]); // Parameters for the SQL query
  
        $stmt = sqlsrv_query($conn, $tsql, $params); // Executing the SQL query on the database connection
        
        // Checking if the query execution failed and throwing an error message if so
        if ($stmt === false) {
          die(print_r(sqlsrv_errors()));
        }
        
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); // Fetching the query result row
            
        print_r($results);
        
        sqlsrv_free_stmt($stmt);
        $userID = 1;
        // Insert the data into the UserIcon table
        $tsql = "INSERT INTO UserIcon (UserID, IconID) VALUES (?, ?)";
        $params = array($userID, $iconID);
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
		
		if ($stmt === false) {
			// code to execute if the SQL statement preparation fails
			//die(print_r(sqlsrv_errors(), true));
		} else {
			// code to execute if the SQL statement preparation succeeds
			
			// execute the SQL statement to insert the item into the database
			if (sqlsrv_execute($stmt) === false) {
				// code to execute if the SQL statement execution fails
				//die(print_r(sqlsrv_errors(), true));
			} else {
				// code to execute if the SQL statement execution succeeds
				echo "";
			}
		}
	}
	
	// close the database connection
	sqlsrv_close($conn);
?>