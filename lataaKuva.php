<?php
	//include_once("db-init.php");
	
	// HUOM! HUOM! oon lisänny tämän mysqli-lauseen omaan db-inttiini, tässä tiedostossa ei jostain syystä
	// toimi db-initin lisääminen, tutkin asiaa...  	
	$mysqli = new mysqli('mysql.labranet.jamk.fi', 'G7753', 'salasana', 'G7753');
	// host, user, password, database
	
	$id = $_GET['id'];
	
	$result = $mysqli->query('SELECT kuva FROM Tapahtuma WHERE tapahtumaID=' . addslashes($id) . ';');
	while($row = $result->fetch_assoc()) {
	$bin = base64_decode($row['kuva']);
	header("Content-Type: image/png");
	header("Content-Length: " . strlen($bin));
	echo $bin;
}
?>