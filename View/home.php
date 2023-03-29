<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");


session_start();
if(isset($_SESSION["FN"])){
    if(null!=$_SESSION["FN"] && null!=$_SESSION["SN"] && null!= $_SESSION["E"]){        
        
    }
}
 else if(null != $_GET["FN"] && null != $_GET["SN"] && null != $_GET["E"]){
    $_SESSION["FN"] = $_GET["FN"];
    $_SESSION["SN"] = $_GET["SN"];
    $_SESSION["E"] = $_GET["E"];
    
}else{
    session_abort();
    ?> <script> alert("Error Authenticating Credentials.\nReturning to Login.");</script><?php
    header("location:index.php ");
}


?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
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
$query = "SELECT Courses.CourseName 
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
  

$conn = connect();
$query = "SELECT Users.UserFN, Users.UserSN, COUNT(UserCourse.CourseID) AS NumCoursesCompleted FROM Users LEFT JOIN UserCourse ON Users.UserID = UserCourse.UserID GROUP BY Users.UserID, Users.UserFN, Users.UserSN";                                       
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$results1 = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results1[] = $row;
}



$query = "SELECT * FROM Courses";
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$results2 = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results2[] = $row;
}

if(isset($_POST["complete"])){

    $courseID = $_POST["complete"];
    
    $sql = $sql = "INSERT INTO UserCourse (CourseID, UserID) VALUES (?, (SELECT UserID FROM Users WHERE UserFN = ? AND UserSN = ? AND UserEmail = ?))";


    $userFN = $_SESSION["FN"];
    $userSN = $_SESSION["SN"];
    $userEmail = $_SESSION["E"];
    $params = array($courseID, $userFN, $userSN, $userEmail);

    // prepare the SQL statement
    $stmt = sqlsrv_prepare($conn, $sql, $params);

  
  // Execute the SQL statement
  if (sqlsrv_execute($stmt)) {
      // SQL statement executed successfully
  } 

}
?>

<div class="container">
<div class="leaderboard-container">
    <h2>User History</h2>
    <table>
      <thead>
        <tr>
          <th>Course Name</th>
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
  <div class="leaderboard-container">
    <h2>Leaderboard</h2>
    <table>
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th># Courses</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach($results1 as $r){
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

  <div class="leaderboard-container">
  <h2>Courses</h2>
   
<table>
  <thead>
    <tr>
      <th>CourseID</th>
      <th>Course Name</th>
      <th>Course Link</th>
      <th>Completed</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach($results2 as $r){
        echo '<tr>';
        foreach($r as $cell){
            echo '<td>' . $cell . '</td>';
        }
        echo '<td><form method = "post"><button type = "submit" name = "complete" value="' . $r['CourseID'] . '">Complete</button></form></td>';// add a button with "Complete" written on it
        echo '</tr>';
    }
    ?>
  </tbody> 
</table>
  </div>

  
</div>

</body>


<script type = "text/javascript" src="../View/scripts/WatsonAssistantCreation.js"></script>

