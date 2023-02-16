<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");


session_start();
if(null!=$_SESSION["FN"] && null!=$_SESSION["SN"] && null!= $_SESSION["E"]){        
    drawHeader();
} else if(null != $_GET["FN"] && null != $_GET["SN"] && null != $_GET["E"]){
    $_SESSION["FN"] = $_GET["FN"];
    $_SESSION["SN"] = $_GET["SN"];
    $_SESSION["E"] = $_GET["E"];
    drawHeader();
}else{
    session_abort();
    ?> <script> alert("Error Authenticating Credentials.\nReturning to Login.");</script><?php
    header("location:index.php ");
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

$conn = connect();
$query = "SELECT Users.UserFN, Users.UserSN, Courses.CourseName 
FROM Users
LEFT JOIN UserCourse ON Users.UserID = UserCourse.UserID 
LEFT JOIN Courses ON UserCourse.CourseID = Courses.CourseID
WHERE Users.UserFN = '{$_SESSION["FN"]}' AND Users.UserSN = '{$_SESSION["SN"]}'";                                       
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$results = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
}
?>


<div class="history-container">
  <h2>User History</h2>
  <table id="history-table">
    <thead>
      <tr>
        <th>User</th>
        <th>Course</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        foreach($results as $r){
            echo '<tr>';
            foreach($r as $cell){
                echo '<td>' . $cell . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </tbody> 
  </table>
</div>
</body>


<script type = "text/javascript" src="../View/scripts/WatsonAssistantCreation.js"></script>

