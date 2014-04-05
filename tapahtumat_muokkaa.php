<?php
	$id = $_GET['id'];
	require_once('db-init.php');
	
	$result = $mysqli->query('SELECT kuva FROM Tapahtuma WHERE tapahtumaID=' . addslashes($id) . ';');
	$row = $result->fetch_assoc();
	
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
		
		// kuva
		/*if(!is_uploaded_file($_FILES['kuva']['tmp_name'])) {
			$kuva = $row['kuva'];
		} else {
			$koodaamaton_kuva = file_get_contents($_FILES['kuva']['tmp_name']);
			$kuva = base64_encode($koodaamaton_kuva);
		}*/
		
		
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
				
				$sql = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
				$db->exec("$sql");
				header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
	
			}
		} else {
			$kuva = $row['kuva'];
			
			$sql = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
			$db->exec("$sql");
			header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
	
		}
		
	//$sql = "UPDATE Tapahtuma SET nimi='$nimi', ajankohta='$ajankohta', jarjestaja='$jarjestaja', kuvaus = '$kuvaus', paikka='$paikka', lipunhinta='$lipunhinta', lippukiintio='$lippukiintio', lippuostorajoitus = '$lippuostorajoitus', kuva = '$kuva', lisatiedot = '$lisatiedot' WHERE tapahtumaID='$id'";
	//$db->exec("$sql");
	//$id = $id;
	//header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_muokkauslomake.php?id=$id");
	
	}
	
	if (isset($_POST['poista'])) {
		$sql = "DELETE FROM Tapahtuma WHERE tapahtumaID = $id";
		$db->exec("$sql");	
		header("Location: http://student.labranet.jamk.fi/~G7753/php/harjoitustyo/tapahtumat_listaa.php");
	}
	
?>