<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");
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
// Query to retrieve leaderboard data
$sql = "SELECT UserID, COUNT(*) AS num_courses_completed FROM UserCourse GROUP BY UserID ORDER BY num_courses_completed DESC";
$stmt = sqlsrv_query($conn, $sql);

// Build leaderboard table HTML
$leaderboard_html = "<thead><tr><th>Rank</th><th>UserID</th><th>Courses Completed</th></tr></thead>";
$leaderboard_html .= "<tbody>";
$rank = 1;
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $leaderboard_html .= "<tr><td>{$rank}</td><td>{$row['UserID']}</td><td>{$row['num_courses_completed']}</td></tr>";
    $rank++;
}
$leaderboard_html .= "</tbody>";
echo $leaderboard_html;
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load initial leaderboard data
            updateLeaderboard();

            // Add click handler for refresh button
            $("#refresh-button").click(function() {
                updateLeaderboard();
            });
        });

        function updateLeaderboard() {
            // Make AJAX request to retrieve leaderboard data
            $.ajax({
                url: "get_leaderboard_data.php",
                success: function(data) {
                    // Replace leaderboard table with updated data
                    $("#leaderboard-table").html(data);
                }
            });
        }
    </script>


    <h1>Course Completion Leaderboard</h1>
    <div id="leaderboard-container">
        <table id="leaderboard-table">
            <!-- Table data will be dynamically updated by JavaScript -->
        </table>
        <button id="refresh-button">Refresh</button>
    </div>
</body>
</html>
