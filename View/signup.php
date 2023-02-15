
<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/CreateUser.php");

isset($_GET["FN"]) ? $FN = $_GET["FN"] : $FN = null;
isset($_GET["SN"]) ? $SN = $_GET["SN"] : $SN = null;
isset($_GET["Email"]) ? $E = $_GET["Email"] : $E = null;
isset($_GET["Pwd"]) ? $P = $_GET["Pwd"] : $P = null;

if($FN != null && $SN != null && $E != null && $P != null) {
	CreateUser($FN, $SN, $E, $P);
	$url = "home.php?FN=".urlencode($FN)."&SN=".urlencode($SN)."&E=".urlencode($E);
	header("Location: $url");	
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
		      	<h3 class="text-center mb-4">Sign Up </h3>
						<form action="#" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="First Name" name="FN" required>
		      		</div>
					  <div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Last Name" Name="SN"required>
		      		</div>
					  <div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Email" Name="Email" required>
		      		</div>
					<div class="form-group d-flex">
					<input type="password" class="form-control rounded-left" placeholder="Password" Name="Pwd" required>
					</div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3" Name = "confirm">Sign Up</button>
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