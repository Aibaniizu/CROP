<?php
include_once('navbar.php');
require_once('db-init.php');
$ostot_taulu = array ('2 ','3 ');
session_start();
$_SESSION['osto'] = $ostot_taulu;
?>

   <form method="POST" action="ostoskori.php">
   <input type="submit" value="Vahvista tilaus" name="vahvista">
   </form>

<?php


?>