<?php

// Function to connect to the database server
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

// Function to retrieve user credentials from the database
function getUserCredentials() {
  $conn = connect(); // Establishing the database connection
  
  $sql = "SELECT userEmail, userPW FROM Users"; // SQL query to retrieve user email and password
  $stmt = sqlsrv_query($conn, $sql); // Executing the SQL query on the database connection
  
  // Checking if the query execution failed and throwing an error message if so
  if ($stmt === false) {
    die("Query failed: " . sqlsrv_errors());
  }
  
  $results = array(); // Initializing an array to store the query results
  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row; // Storing each row of the query result in the results array
  }
  
  sqlsrv_free_stmt($stmt); // Freeing up the statement resources
  sqlsrv_close($conn); // Closing the database connection
  
  return $results; // Returning the query results
}

// Function to retrieve user details from the database
function setDetails($userEmail, $userPW){
  $conn = connect(); // Establishing the database connection

  $query = "SELECT * FROM users WHERE userEmail = ? AND userPW = ?"; // SQL query to retrieve user details with given email and password
  $params = array($userEmail, $userPW); // Parameters for the SQL query
  
  $stmt = sqlsrv_query($conn, $query, $params); // Executing the SQL query on the database connection
  
  // Checking if the query execution failed and throwing an error message if so
  if ($stmt === false) {
    die("Error executing query: " . sqlsrv_errors());
  }
  
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); // Fetching the query result row
  
  // Checking if the query returned no rows and throwing an error message if it has
  if (!$row) {
    die("User not found.");
  }
  
  sqlsrv_close($conn); // Closing the database connection
  
  return $row; // Returning the Result
}
?>