
<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/DBConnect.php");
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
		      			<input type="text" class="form-control rounded-left" placeholder="First Name" required>
		      		</div>
					  <div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Last Name" required>
		      		</div>
					  <div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Email" required>
		      		</div>
					  <div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="University" required>
		      		</div>
					<div class="form-group d-flex">
					<input type="password" class="form-control rounded-left" placeholder="Password" required>
					</div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
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