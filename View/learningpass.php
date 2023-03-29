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

  
?>

	<div class="battle-pass" style="padding-top: 2%">
      <h3> Current Progress </h3>
        <div class="progress-bar">
            <div class="progress-bar__fill"></div>
                <div class="progress-bar__text">Level 1 - 0%</div>
                    <div class="progress-bar__next-level">Level 2 - 5%</div>

    </div>

<button onclick="updateProgressBar()">Increase Level</button>

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
	</div>
      <script src = "../View/scripts/LearningPass.js"></script>