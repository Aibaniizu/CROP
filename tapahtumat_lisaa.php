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
	
	$paivays = "20[0-9]{2,2}-[01]{1,1}[0-9]{1,1}-[0-3]{1,1}[0-9]{1,1}$";
	
	// kuva
	if(is_uploaded_file($_FILES['kuva']['tmp_name'])) {
		$maxsize = 90000;
		$errors = array();
		
		// kuva liian iso
		if ($_FILES['kuva']['size'] >= $maxsize) {
			$errors[] = 'Kuva liian iso';
			echo "<script type='text/javascript'>alert('Kuva liian iso, kuvan maksimikoko on 300px x 300px');</script>";
		}

		// jos kuva ja päiväys ok
		if (count($errors) === 0 && preg_match("/$paivays/",$ajankohta)){
			$koodaamaton_kuva = file_get_contents($_FILES['kuva']['tmp_name']);
			$kuva = base64_encode($koodaamaton_kuva);
			
			$sql = "INSERT INTO Tapahtuma(nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot) VALUES('$nimi', '$ajankohta', '$jarjestaja', '$kuvaus', '$paikka', '$lipunhinta', '$lippukiintio', '$lippuostorajoitus', '$kuva', '$lisatiedot')";
			$db->exec("$sql");
		// päiväys väärin
		} else {
			echo "<script type='text/javascript'>alert('Ajankohta on väärin, anna muodossa vvvv-kk-pp');</script>";
		}
		
	// jos ei kuvaa	
	} else {
		$kuva = "Ei kuvaa";
		
		// päiväys ok
		if (preg_match("/$paivays/",$ajankohta)) {
			$sql = "INSERT INTO Tapahtuma(nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot) VALUES('$nimi', '$ajankohta', '$jarjestaja', '$kuvaus', '$paikka', '$lipunhinta', '$lippukiintio', '$lippuostorajoitus', '$kuva', '$lisatiedot')";
			$db->exec("$sql");
		// päiväys väärin
		} else {
			echo "<script type='text/javascript'>alert('Ajankohta on väärin, anna muodossa vvvv-kk-pp');</script>";
		}
	}
	
	
	
	
	
}

?>