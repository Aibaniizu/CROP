<?php
include_once('navbar.php');
require_once('db-init.php');
//testataan sessiota
?>
<h1>testi</h1>
<?php

$ostot_taulu[] = array("id" => 1);
$ostot_taulu[] = array("maara" => 3);

print_r($ostot_taulu);
$_SESSION['osto'][] = $ostot_taulu;
?>

   <form method="POST" action="ostoskori.php">
   <input type="submit" value="Vahvista tilaus" name="vahvista">
   </form>

<?php


?>