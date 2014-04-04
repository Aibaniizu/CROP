<?php
require_once('db-init.php'); 
include_once('navbar.php');


?>

<form method='get' action='profiilin_ohjaussivu.php'> 
<h1> Tilaushistoria </h1>

<table border='0' cellpadding='5'>
<?php include ('profiilin_tilausten_haku.php');?>
</table>



</form>