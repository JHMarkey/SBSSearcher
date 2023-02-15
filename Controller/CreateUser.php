
<?php
function CreateUser($UserFN, $UserSN, $UserEmail, $UserPW) {
  // Connect to the Azure SQL Server database
  $serverName = "sbss.database.windows.net";
  $connectionOptions = array(
    "Database" => "sbsdb",
    "Uid" => "phpdbLogin",
    "PWD" => "php-Password123",
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
  );
  $conn = sqlsrv_connect($serverName, $connectionOptions);
  
  if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  // Define the SQL query to insert the user into the database
  $sql = "INSERT INTO Users (UserFN, UserSN, UserEmail, UserPW) VALUES (?, ?, ?, ?)";
  $params = array($UserFN, $UserSN, $UserEmail, $UserPW);
  
  // Prepare and execute the SQL query
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

?>