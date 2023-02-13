<?php
  // Connect to the Azure database
  $host = "your-azure-server-name.database.windows.net";
  $user = "your-username";
  $pass = "your-password";
  $db = "your-database-name";
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  // Check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // Get the username and password from the form
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  // Check if the username and password match any records in the database
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // Login successful
    header("Location: welcome.php");
  } else {
    // Login failed
    echo "Username or password is incorrect. Please try again.";
  }
  
  // Close the connection
  mysqli_close($conn);
?>
