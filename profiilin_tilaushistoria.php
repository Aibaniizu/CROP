<?php
require_once('db-init.php'); 
include_once('navbar.php');


?>
<style type='text/css'>
.content {width:800px; margin:0 auto;}
.btn {margin-top:10px;}
</style>

<div class='content'>
<form method='get' action='profiilin_ohjaussivu.php'> 
<h3> Tilaushistoria </h3>

<table border='0' cellpadding='5'>
<?php include ('profiilin_tilausten_haku.php');?>
</table>

</form>
</div>