<?php
	$id = $_GET['id'];
	
	if (isset($_POST['action'])) {
		$nimi = $_POST['nimi'];
		$ajankohta = $_POST['ajankohta'];
		$jarjestaja = $_POST['jarjestaja'];
		$kuvaus = $_POST['kuvaus'];
		$paikka = $_POST['paikka'];
		$lipunhinta = $_POST['lipunhinta'];
		$lippukiintio = $_POST['lippukiintio'];
		$lippuostorajoitus = $_POST['lippuostorajoitus'];
		$lisatiedot = $_POST['lisatiedot'];
		
		// kuva
		$koodaamaton_kuva = file_get_contents($_FILES['kuva']['tmp_name']);
		$kuva = base64_encode($koodaamaton_kuva);
		
	$sqli = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
	$db->exec("$sqli");
	//$id = $id;
	header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
	
	echo "<h4>Muokkaus onnistui</h4>";
	}
	
?>