<?php
// HUOM HUOM! Sain toimimaan PDO:lla, mutta db-initin lisäys ei edelleenkään toimi....
//require_once('db-init.php');
	$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=G7753;charset=utf8','G7753', 'salasana');
	$id = $_GET['id'];
	
	$result = $db->query('SELECT kuva FROM Tapahtuma WHERE tapahtumaID=' . addslashes($id) . ';');
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {	
		$bin = base64_decode($row['kuva']);
		header("Content-Type: image/png");
		header("Content-Length: " . strlen($bin));
		echo $bin;
	}
?>