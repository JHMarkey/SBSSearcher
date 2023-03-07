<?
    session_start();
    unset($_SESSION['FN']);
    unset($_SESSION['SN']);
    unset($_SESSION['E']);
    session_destroy();

    header("location:../View/index.php ");
?>
