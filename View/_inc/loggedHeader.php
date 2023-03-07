<?php 
function drawHeader(){?>

<body style = "margin-top: 0">
  <div class = "header">
    <div class="inner_header">
      <div class="logo_container">
        <h1><a href = "home.php">SBS</a></h1>
      </div>
      <ul class = "navigation">
        <a><li><?php 
            echo($_SESSION["FN"]. " ". $_SESSION["SN"])
            ?></li>
        </a>         
        <a href = "index.php"><li>Log Out</li></a>
      </ul>
    </div>
  </div>

  <?php }?>
  