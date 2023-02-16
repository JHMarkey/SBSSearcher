<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");
session_start();
drawHeader();

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
$query = "SELECT Users.UserID, Users.UserFN, Users.UserSN, COUNT(UserCourse.CourseID) AS NumCoursesCompleted FROM Users LEFT JOIN UserCourse ON Users.UserID = UserCourse.UserID GROUP BY Users.UserID, Users.UserFN, Users.UserSN";                                       
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$results = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
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
?>


<div class="leaderboard-container">
  <h2>Leaderboard</h2>
  <table id="leaderboard-table">
    <thead>
      <tr>
        <th>Rank</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th># Courses</th>
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
  <h2>Courses</h2>
  <table id="leaderboard-table">
    <thead>
      <tr>
        <th>CourseID</th>
        <th>Course Name</th>
        <th>Course Link </th>
      </tr>
    </thead>
    <tbody>
        <?php 
        foreach($results2 as $r){
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
</html>
