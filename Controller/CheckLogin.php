<?php
function authenticateUser($userEmail, $password) {
    $serverName = "sbss.database.windows.net";
    $databaseName = "sbsdb";
    $username = "phpdbLogin";
    $password = "php-Password123";

    try {
        $conn = new PDO("sqlsrv:server=$serverName;database=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM Users WHERE userEmail = :userEmail AND userPW = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":userEmail", $userEmail);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (count($result) == 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}

?>