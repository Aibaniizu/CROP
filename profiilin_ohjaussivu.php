<?php

session_start();

$page = $_GET['action'];
$id = $_GET['id'];

echo $page;

if ($page == 'Muokkaa tietoja') {
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_muokkaus.php?id=".$id); 

}
if ($page == 'Katso tilaushistoria') {
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tilaushistoria.php?id=".$id); 

}
if ($page == 'Peruuta') {
//setcookie('succeed');
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tiedot.php?id=".$id); 

}
if ($page == 'Jatka') {
//setcookie('succeed');
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tiedot.php?id=".$id); 

}

?>
<input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>