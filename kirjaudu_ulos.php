<?php 
session_start();
  // $_SESSION['kirjautunut'] = false;
  unset ($_SESSION['kirjautunut']);
  unset ($_SESSION['tunnus']);

    header("Location: http://" . $_SERVER['HTTP_HOST']
                               . dirname($_SERVER['PHP_SELF']) . '/'
                               . "etusivu.php");
?>
