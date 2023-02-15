
<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/CheckLogin.php");

$status = "Not Working";
$result = getUserCredentials();
$correctEmail = false;
$correctPwd = false;

$userEmail = $_GET["UserEmail"];
$pwd = $_GET["Password"];

for($i = 0; $i < count($result); $i++){
	if(!$correctEmail){
		$correctEmail = ($result[$i]["userEmail"] == $userEmail);
	}
	if(!$correctPwd){
		$correctPwd = $result[$i]["userPW"] == $pwd;
	}		
}
session_start();
$correctEmail && $correctPwd ? $_SESSION["LoggedIn"] = true : $_SESSION["LoggedIn"] = false;

if($_SESSION["LoggedIn"]){
	header("Location: http://localhost/dashboard/SkillsBuildSearcher/View/home.php");
} else{
	print_r($result);
}

?>
<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Sign In</h3>
						<form action="#" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Email" name="UserEmail" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="Password" required>
	            </div>
	            <div class="form-group">
					<input class="btn btn-primary btn-lg" type="submit" value="Login" id="confirm" name="confirm"/>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
								
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
<?php
require("../View/_inc/Footer.php");
?>