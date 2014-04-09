<?php
	session_start();
	require_once('db-init.php');
	include_once('navbar.php');
	
	alustaKanta($db);
	
	if (isset($_GET['valitse'])) {
		$_SESSION['taso'] = $_GET['tasot'];
		$aika = time();
		header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?$aika");
	} 
	$taso = $_SESSION['taso'];
	
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

$taso = $_SESSION['taso'];
if($taso >= 1) {
	$tapahtuma = <<<END
		<form method='post' action='tapahtumat_tapahtumasivu.php?id=$id'>
			<h2>$nimi</h2></br>
			<p>$kuvaus</p></br>
			<p>Milloin? $ajankohta<p></br>
			<p>Kuka järkkää? $jarjestaja</p></br>
			<p>Missä? $paikka</p></br>
			<p>Paljon maksaa? $lipunhinta €/kpl</p></br>
			<img src="lataaKuva.php?id=$id" width="300" height="300">
			<input type='number' name='maara' min='1' max='$lippuostorajoitus'>kpl
			<input type='submit' name='osta' value='Osta'>
		</form>
END;
} else {
	$tapahtuma = <<<END
		<form method='post' action='tapahtumat_tapahtumasivu.php?id=$id'>
			<h2>$nimi</h2></br>
			<p>$kuvaus</p></br>
			<p>Milloin? $ajankohta<p></br>
			<p>Kuka järkkää? $jarjestaja</p></br>
			<p>Missä? $paikka</p></br>
			<p>Paljon maksaa? $lipunhinta €/kpl</p></br>
			<img src="lataaKuva.php?id=$id" width="300" height="300">
			<p>Kirjaudu sisään ostaaksesi lippuja!</p>
		</form>
END;
}
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