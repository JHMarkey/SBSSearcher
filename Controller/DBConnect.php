<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:skillsbuildsearcherserver.database.windows.net,1433; Database = SBSDB", "c1009859@hallam.shu.ac.uk", "H4nn4H1812!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "c1009859@hallam.shu.ac.uk", "pwd" => "H4nn4H1812!", "Database" => "SBSDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:skillsbuildsearcherserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>