<?php
    $tsql = "SELECT [UserEmail],[UserPW] FROM [dbo].[Users]";
    $getResults = sqlsrv_query($conn, $tsql);

    if($getResults == false){
        echo(sqlsrv_errors())
    } else{
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            echo ($row['CategoryName'] . " " . $row['ProductName'] . PHP_EOL);
           }
        }
    sqlsrv_free_stmt($getResults);
    
?>