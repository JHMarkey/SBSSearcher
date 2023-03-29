<?php
require("head.php");
?>
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <!-- Collapse 1 -->
        <a
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
          data-mdb-toggle="collapse"
          href="#collapseExample1"
          aria-expanded="true"
          aria-controls="collapseExample1"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>NAVIGATION</span>
        </a>
        <!-- Collapsed content -->
        <ul id="collapseExample1" class="collapse show list-group list-group-flush">
        <li class="list-group-item py-1">
            <a href="../View/test.php" class="text-reset">Chat Bot</a>
          </li>
          <li class="list-group-item py-1">
            <a href="../View/home.php" class="text-reset">Leaderboard</a>
          </li>
          <li class="list-group-item py-1">
            <a href="../View/learningpass.php" class="text-reset">Learning Pass</a>
          </li>
          <li class="list-group-item py-1">
            <a href="../View/iconwheel.php" class="text-reset">Icon Wheel</a>
          </li>
          <!-- Logout -->
          <li class="list-group-item py-1 mt-auto">
              <a href="../Controller/logout.php" class="text-reset">Logout <i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
        <!-- Collapse 1 -->

        
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="home.php">
        <img
          src="../Assets/Icons/SBSLogo.jpg"
          height="10px"
          alt="SBS"
          loading="lazy"
        />
      </a>

        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
            class="nav-link d-flex align-items-center"
            href="../View/profile.php"
        >
            <img
              src="../Assets/Icons/bunny.png"
              class="rounded-circle"
              height="10px"
              alt="Avatar"
              loading="lazy"
            />
          </a>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">

<!--Main layout-->