<?php

$page = $_GET['action'];
echo $page;

if ($page == 'Muokkaa tietoja') {
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_muokkaus.php"); 

}
if ($page == 'Tilaushistoria') {
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tilaushistoria.php"); 

}

?>