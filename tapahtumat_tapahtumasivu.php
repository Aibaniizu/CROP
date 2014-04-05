<?php
	session_start();
	require_once('db-init.php');
	include_once('navbar.php');

	
	alustaKanta($db);
	
function alustaKanta($db) {

	$tietue = $_GET['id'];
		
	$sql = <<<SQLEND
		SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
		FROM Tapahtuma WHERE tapahtumaID = :tapahtumaID;
SQLEND;
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':tapahtumaID', $tietue, PDO::PARAM_STR);
	$stmt->execute();
	
	teeTapahtumasivu($stmt);
}


function teeTapahtumasivu($stmt) {

$id = $_GET['id'];

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$nimi = $row['nimi'];
$ajankohta = $row['ajankohta'];
$jarjestaja = $row['jarjestaja'];
$kuvaus = $row['kuvaus'];
$paikka = $row['paikka'];
$lipunhinta = $row['lipunhinta'];
$lippukiintio = $row['lippukiintio'];
$lippuostorajoitus = $row['lippuostorajoitus'];

$tapahtuma = <<<END
	<form method='post' action='tapahtumat_tapahtumasivu.php?id=$id'>
		<h2>$nimi</h2></br>
		<p>$kuvaus</p></br>
		<p>Milloin? $ajankohta<p></br>
		<p>Kuka järkkää? $jarjestaja</p></br>
		<p>Missä? $paikka</p></br>
		<p>Paljon maksaa? $lipunhinta €/kpl</p></br>
		<input type='number' name='maara' min='1' max='$lippuostorajoitus'>kpl
		<input type='submit' name='osta' value='Osta'>
	</form>
	
END;

echo $tapahtuma;

}

if (isset($_POST['osta'])) {
	$maara = $_POST['maara'];
	$id = $_GET['id'];
	$liput = array("$id", "$maara");
	
	echo "id = " . $liput[0] . "<br>";
	echo "maara = " . $liput[1] ."<br>";
	
	$_SESSION['osto'] = $liput;
	
	echo "sesid = " . $_SESSION['osto'][0] . "<br>";
	echo "sesmaara = " . $_SESSION['osto'][1];
	
	
	}

?>