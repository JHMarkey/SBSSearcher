<?php 
require ("../View/_inc/head.php");
//require("../View/_inc/header.php");
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

  // Get numCourses

  $query = "SELECT Users.UserFN, Users.UserSN, COUNT(UserCourse.CourseID) AS NumCoursesCompleted FROM Users LEFT JOIN UserCourse ON Users.UserID = UserCourse.UserID GROUP BY Users.UserID, Users.UserFN, Users.UserSN";                                       
  $stmt = sqlsrv_query($conn, $query);
  if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
  }
  $level=0;
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  $NumCoursesCompleted = $row['NumCoursesCompleted'];
  $currentProgress = $NumCoursesCompleted * 20;
  if($currentProgress >= 100){
    $level++;
    $currentProgress %= 100;
  }
  

?>

<div class="battle-pass" style="padding-top: 2%">
  <h3>Current Progress</h3>
  <div class="progress-bar">
    <div class="progress-bar__fill" style="width: <?php echo $currentProgress ?>%;"></div>
    <div class="progress-bar__text">Level <?php echo $level?> - <?php echo $currentProgress ?>%</div>
    <div class="progress-bar__next-level">Level <?php echo $level + 2 ?> - <?php echo ($level + 2) % 100 == 0 ? '100' : (($level + 2) % 100) * 5 ?>%</div>
  </div>
  <div class="level-rewards">
    <h3>Level Rewards</h3>
    <div id="container">
      <?php
        for ($i = 1; $i <= 20; $i++) {
          echo '<div class="reward-box">';
          echo '<img src="../Assets/Icons/reward-' . $i . '.png" alt="Reward ' . $i . '" class="reward-image">';
          echo '<div>Reward ' . $i . '</div>';
          echo '</div>';
        }
      ?>
    </div>
  </div>
  <div class="claim-reward">
    <form method="POST">
      <input type="submit" name="claim" value="Claim">
    </form>
    <?php
    $userID = 5;
      if (isset($_POST['claim'])) {
        $query = "INSERT INTO UserEquip(UserID, EID, Selected) VALUES (?,?,?)";
        $params = array($userID, $level, 0); 
        $stmt = sqlsrv_prepare($conn, $query, $params);
        if (!$stmt) {
          die(print_r(sqlsrv_errors(), true));
        }
        if (sqlsrv_execute($stmt)) {
          echo '<p>Claimed!</p>';
        } else {
          echo '<p>Already Claimed this Level!</p>';
        }
      }
    ?>
  </div>
</div>
