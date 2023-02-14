<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/DBConnect.php");
?>


  <head>
    <title>My Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-3 bg-light">
          <nav class="navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="#">My Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        <div class="col-9">
          <div class="row">
            <div class="col">
              <h1>Welcome to My Site</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor aliquet odio, quis mollis purus efficitur vitae.</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <form>
                <div class="form-group">
                  <label for="backendTextarea">Talk to the backend:</label>
                  <textarea class="form-control" id="backendTextarea" rows="3"></textarea>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

<?php
require("../View/_inc/Footer.php");
?>