<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");

session_start();  
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
$fn = $_SESSION['FN'];
  $sn = $_SESSION['SN'];
  $e = $_SESSION['E'];
  $sql = "SELECT UserID FROM Users WHERE UserFN = ? AND UserSN = ? AND UserEmail = ?";
  $params = array($fn, $sn, $e);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
  die(print_r(sqlsrv_errors()));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if(!empty($row)){
  $userID = $row['UserID'];

  // Query the UserIcon table to get all unlocked icons for the current user
  $sql = "SELECT IconID FROM UserIcon WHERE UserID = ?";
  $params = array($userID);
  $idstmt = sqlsrv_query($conn, $sql, $params); 
  
  $esql = "SELECT EID FROM UserEquip WHERE UserID = ?";
  $params = array($userID);
  $estmt = sqlsrv_query($conn, $esql, $params); 
  
}else{
  $name = "Currently No Available Icons, Complete Courses to unlock some";
}

$sql = "UPDATE UserIcon SET Selected=0 WHERE UserID = ?";
$params = array($userID);
$ustmt = sqlsrv_prepare($conn, $sql, $params);  
?>

<section class="vh-100 gradient-custom">
    <div class="container py-8 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Customise Profile</h3>
                        <form method = "post">  

                        <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="UserFirstName" class="form-control form-control-lg" name ="UserFirstName" value = "<?php echo $_SESSION['FN'];?>"/>
                                        <label class="form-label" for="UserFirstName">First Name</label>                                        
                                    </div>
                                </div>    
                                
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="UserLastName" class="form-control form-control-lg" name ="UserLastName" value = "<?php echo $_SESSION['SN'];?>" />
                                        <label for="Pwd" class="form-label">Last Name</label>                                        
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">  
                                        <input type="email" id="UserEmail" name ="UserEmail" class="form-control form-control-lg" value = "<?php echo $_SESSION['E'];?>"/>
                                        <label class="form-label" for="UserEmail">Email Address</label>                                        
                                    </div>

                            <div class="row">
                                <div class="col-10">
                                    <select class="select form-control-lg" name="IconSelection">
                                        <option value="Default" disabled>-----Select Icon-----</option>
                                        <?php
                                          while($row = sqlsrv_fetch_array($idstmt, SQLSRV_FETCH_ASSOC)){    
                                          $iconID = $row['IconID'];
                                          $sql = "SELECT IconName FROM Icons WHERE IconID = ?";
                                          $params = array($iconID);
                                          $stmt = sqlsrv_query($conn, $sql, $params);
                                          $name= "";
                                          if(empty($row)){
                                            $name = "Currently No Available Icons, Complete Courses to unlock some";
                                          }else{            
                                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                              $name = $row['IconName'];                                                        
                                            }       
                                          }    
                                          echo "<option value ='$name'>$name";
                                          }  
                                        ?>                                     
                                    </select>
                                    <label class="form-label select-label">Select Icon</label>
                                </div>
                              
                                <div class="col-10" style = "padding-top: 10px" >
                                    <select class="select form-control-lg" name="EquipmentSelection">
                                        <option value="Default" disabled>-----Select Tool-----</option>
                                        <?php   
                                          while($row = sqlsrv_fetch_array($estmt, SQLSRV_FETCH_ASSOC)){    
                                          $eID = $row['EID'];
                                          $sql = "SELECT EName FROM Equipment WHERE EID = ?";
                                          $params = array($eID);
                                          $stmt = sqlsrv_query($conn, $sql, $params);
                                          $name= "";
                                          if($stmt === false){
                                            $name = "Currently No Available Tools, Complete Courses to unlock some";
                                          }else{            
                                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                              $name = $row['EName'];                                                        
                                            }       
                                          }    
                                          echo "<option value ='$name'>$name</option>";
                                          }  
                                        ?> 
                                    </select>
                                    <label class="form-label select-label">Select Tool</label>
                                </div>
                            </div>
                            <div class="row" sytle="padding-top:25px">                                
                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" value="Submit" id="confirm" name="confirm"/>
                                </div>
                            </div>      
                        </form>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Clean up
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>