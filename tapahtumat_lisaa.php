<?php

if (isset($_POST['tallenna'])) {
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
	if(is_uploaded_file($_FILES['kuva']['tmp_name'])) {
		$maxsize = 90000;
		$errors = array();
		
		if ($_FILES['kuva']['size'] >= $maxsize) {
			$errors[] = 'Kuva liian iso';
			echo "<script type='text/javascript'>alert('Kuva liian iso, kuvan maksimikoko on 300px x 300px');</script>";
		}
		if (count($errors) === 0) {
			$koodaamaton_kuva = file_get_contents($_FILES['kuva']['tmp_name']);
			$kuva = base64_encode($koodaamaton_kuva);
			
			$sql = "INSERT INTO Tapahtuma(nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot) VALUES('$nimi', '$ajankohta', '$jarjestaja', '$kuvaus', '$paikka', '$lipunhinta', '$lippukiintio', '$lippuostorajoitus', '$kuva', '$lisatiedot')";
			$db->exec("$sql");
		}
	} else {
		$kuva = "Ei kuvaa";
		
		$sql = "INSERT INTO Tapahtuma(nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot) VALUES('$nimi', '$ajankohta', '$jarjestaja', '$kuvaus', '$paikka', '$lipunhinta', '$lippukiintio', '$lippuostorajoitus', '$kuva', '$lisatiedot')";
		$db->exec("$sql");
	}
	
	
	
	
	
}

?>