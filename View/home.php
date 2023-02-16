<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");

if(null != $_GET["FN"] && null != $_GET["SN"] && null != $_GET["E"]){
    session_start();
    $_SESSION["FN"] = $_GET["FN"];
    $_SESSION["SN"] = $_GET["SN"];
    $_SESSION["E"] = $_GET["E"];
    drawHeader();
} else{
    ?> <script> alert("Error Authenticating Credentials.\nReturning to Login.");</script><?php
    header("location:index.php ");
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
// Assuming you have already started a session and have the UserFn and UserSn stored as session variables
$userFn = $_SESSION['FN'];
$userSn = $_SESSION['SN'];

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

// Build the SQL query to select the user IDs for the given UserFn and UserSn
$sql = "SELECT UserId FROM users WHERE UserFN='$userFn' AND UserSn='$userSn'";

// Execute the SQL query
$result = sqlsrv_query($conn, $sql);

// Check for errors
$errors = sqlsrv_errors();
if ($errors != null) {
  die("Error executing SQL query: " . print_r($errors, true));
}

// Check for errors and make sure there is at least one row returned
if ($result === false) {
    die("Error executing SQL query: " . $conn->error);
  } elseif (sqlsrv_has_rows($result) === false) {
    echo "No matching users found";
  } else {
    // Loop through the results and display each user ID in a list
    echo '<body>';
    echo '<div style="background-color: #f5f5f5; padding: 20px;">';
    echo '<h3 style="color: #333333;">Courses Complete</h3>';
    echo '<ul style="list-style: none; padding: 0;">';
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
      echo '<li>' . $row['UserId'] . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '</body>';
  }


?>


<script type = "text/javascript" src="../View/scripts/WatsonAssistantCreation.js"></script>

