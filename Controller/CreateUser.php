
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


function CreateUser($UserFN, $UserSN, $UserEmail, $UserPW) {
  $conn = connect();

  // Define the SQL query to insert the user into the database
  $sql = "INSERT INTO Users (UserFN, UserSN, UserEmail, UserPW) VALUES (?, ?, ?, ?)";
  $params = array($UserFN, $UserSN, $UserEmail, $UserPW);
  
  // Prepare and execute the SQL query and throw an error if at any point an execution fails
  $stmt = sqlsrv_prepare($conn, $sql, $params);
  if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  // Close the database connection
  sqlsrv_close($conn);
  
  // Return a success message
  return "User created successfully";
}
?>
