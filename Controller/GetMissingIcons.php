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

// Define the user ID of the current user
$user_id = 1;

// Prepare the SQL statement to select the icons that the user currently has
$user_icons_sql = "SELECT IconID FROM UserIcon WHERE UserID = ?";
$user_icons_params = array($user_id);
$user_icons_stmt = sqlsrv_prepare($conn, $user_icons_sql, $user_icons_params);
if (!$user_icons_stmt) {
    die(print_r(sqlsrv_errors(), true));
}

// Execute the user icons SQL statement
if (!sqlsrv_execute($user_icons_stmt)) {
    die(print_r(sqlsrv_errors(), true));
}

// Create an array to store the IDs of the icons that the user currently has
$user_icon_ids = array();
while ($row = sqlsrv_fetch_array($user_icons_stmt, SQLSRV_FETCH_ASSOC)) {
    $user_icon_ids[] = $row['IconID'];
}

// Prepare the SQL statement to select all icons that the user does not have
$not_user_icons_sql = "SELECT * FROM Icons WHERE IconID NOT IN (" . implode(",", array_fill(0, count($user_icon_ids), "?")) . ")";
$not_user_icons_params = $user_icon_ids;
$not_user_icons_stmt = sqlsrv_prepare($conn, $not_user_icons_sql, $not_user_icons_params);
if (!$not_user_icons_stmt) {
    die(print_r(sqlsrv_errors(), true));
}

// Execute the not user icons SQL statement
if (!sqlsrv_execute($not_user_icons_stmt)) {
    die(print_r(sqlsrv_errors(), true));
}

// Create an array to store the icons that the user does not have
$not_user_icons = array();
while ($row = sqlsrv_fetch_array($not_user_icons_stmt, SQLSRV_FETCH_ASSOC)) {
    $not_user_icons[] = $row;
}

// Close the SQL statements and database connection
sqlsrv_free_stmt($user_icons_stmt);
sqlsrv_free_stmt($not_user_icons_stmt);
sqlsrv_close($conn);

// Now $not_user_icons array should contain all icons that the user does not have
?>