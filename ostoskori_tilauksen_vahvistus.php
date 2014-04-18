<?php
include_once('navbar.php');
require_once('db-init.php');
?>
<h1>Tilauksen vahvistus</h1>
<?php
if(isset($_POST['vahvista']) && isset($_SESSION['osto']) && !empty($_SESSION['osto']) && $_POST['maksutapa'] != 'ei valittu' && $_POST['toimitustapa'] != 'ei valittu'){

//get date
$pvm = date('Y-m-d');

$toimitustapa = $_POST['toimitustapa'];
$maksutapa = $_POST['maksutapa'];
$lisatiedot = $_POST['lisatiedot'];
$tunnus = $_SESSION['tunnus'];
$tapahtumaID;
$tilausnumero;
$maara = 0;

	$sql = <<<SQLEND
    INSERT INTO Tilaus (paivamaara, toimitustapa, maksutapa, lisatiedot, Kayttaja_sahkoposti)
	VALUES ('$pvm', '$toimitustapa', '$maksutapa', '$lisatiedot', '$tunnus')
SQLEND;
	
	$db->exec("$sql");
//echo "ID of last inserted record is: " . mysql_insert_id();
	foreach ($_SESSION['osto'] as $tilausrivi) {
	foreach ($tilausrivi AS	$kentta) {
	foreach($kentta as $arvo => $diu) {
	
		if($arvo == 'id'){
			$tapahtumaID = $diu;
			
			$stmt = haeTilaus($db, $tunnus);
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$tilausnumero = $row['tilausnumero'];

}
		}
		else{
			$maara = $diu;
			
			for($i = 0; $i < $maara; $i++){
	$sql2 = <<<SQL2END
    INSERT INTO Asiakkaan_lippu (tilausnumero, tapahtumaID)
	VALUES ('$tilausnumero', '$tapahtumaID')
SQL2END;

	$db->exec("$sql2");	
			}
		}
	}
	}}

echo "Tilauksenne on vastaanotettu.";	
	unset ($_SESSION['osto']);
}
else{

echo "Tilauksen käsittelyssä tapahtui ongelma.";

}


//haetaan tapahtuman tiedot
function haeTilaus($db, $tunnus) {
    $sql = <<<SQLEND
    SELECT tilausnumero
    FROM Tilaus WHERE Kayttaja_sahkoposti=:tunnus
SQLEND;
 
			$stmt = $db->prepare("$sql");
			$stmt->bindValue(':tunnus', "$tunnus", PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;    
}

?>