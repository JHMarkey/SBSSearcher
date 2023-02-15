<?php 
function drawHeader(){?>

<body style = "margin-top: 0">
  <div class = "header">
    <div class="inner_header">
      <div class="logo_container">
        <h1>SBS</h1>
      </div>
      <ul class = "navigation">
        <a><li><?php 
            session_start();
            echo($_SESSION["FN"]. " ". $_SESSION["SN"])
            ?></li>
        </a>         
        <a href = "http://localhost/dashboard/SkillsBuildSearcher/Controller/Logout.php"><li>Log Out</li></a>    
		</ul>
    </div>
  </div>

  <?php }?>