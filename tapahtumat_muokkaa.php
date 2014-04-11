<?php
	$id = $_GET['id'];
	require_once('db-init.php');
	
	$result = $db->query('SELECT kuva FROM Tapahtuma WHERE tapahtumaID=' . addslashes($id) . ';');
	$row = $result->fetch(PDO::FETCH_ASSOC);
	
	if (isset($_POST['muokkaa'])) {
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
			if (count($errors) === 0 && preg_match("/$paivays/",$ajankohta)) {
				$koodaamaton_kuva = file_get_contents($_FILES['kuva']['tmp_name']);
				$kuva = base64_encode($koodaamaton_kuva);
				
				$sql = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
				$db->exec("$sql");
				header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
			// päiväys väärin
			} else {
				echo "<script type='text/javascript'>alert('Ajankohta on väärin, anna muodossa vvvv-kk-pp');</script>";
			}
		} else {
			$kuva = $row['kuva'];
			
			// päiväys ok
			if (preg_match("/$paivays/",$ajankohta)) {
				$sql = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
				$db->exec("$sql");
				header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
			// päiväys väärin
			} else {
				echo "<script type='text/javascript'>alert('Ajankohta on väärin, anna muodossa vvvv-kk-pp');</script>";
			}
		}
		
	}
	
	if (isset($_POST['poista'])) {
		$sql = "DELETE FROM Tapahtuma WHERE tapahtumaID = $id";
		$db->exec("$sql");	
		header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_listaa.php");
	}
	
?>