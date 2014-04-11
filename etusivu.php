<?php 

include_once('navbar.php');
require_once('db-init.php');
//session_start();

if (isset($_SESSION['tunnus'])) {
	$kayttaja = "<h3>Olet kirjautunut tunnuksella ".$_SESSION['tunnus'].". Tervetuloa ostoksille!</h3>";
} else $kayttaja = "<h3>Tervetuloa ostoksille!</h3>";

?>

<?php echo $kayttaja; ?>
