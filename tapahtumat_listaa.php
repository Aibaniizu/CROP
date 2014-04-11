<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>

<?php
// mysql-pdo-search.php
session_start();
require_once('db-init.php');
include_once('navbar.php');

$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
    
$stmt = haeTapahtumat($db, $hakuehto);
sqlResult2Html($stmt);

if (isset($_GET['valitse'])) {
	$_SESSION['taso'] = $_GET['tasot'];
	flush();
	$aika = time();
    header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?$aika");
} else if(isset($_SESSION['taso'])){
	$_SESSION['taso'] = $_SESSION['taso'];
} else if (!isset($_SESSION['taso'])){
	$_SESSION['taso'] = 0;
}
$taso = $_SESSION['taso'];

// tapahtumien järjestys
function haeTapahtumat($db, $hakuehto) {

	if(!isset($_GET['jarjestys'])) {
	   $sql = <<<SQLEND
		   SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
		   FROM Tapahtuma
SQLEND;
	} /*else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'TapahtumaID') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma WHERE tapahtumaID
			LIKE :hakuehto 
			ORDER BY tapahtumaID ASC
SQLEND;
	
	
	}*/ else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'TapahtumaID') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY tapahtumaID DESC
SQLEND;
	$AD = true;
	
	}else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Tapahtuma') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY nimi
SQLEND;
	} else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Ajankohta') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY ajankohta
SQLEND;
	} else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Jarjestaja') {
		$sql = <<<SQLEND
			 SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY jarjestaja
SQLEND;
	} else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Kuvaus') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY kuvaus
SQLEND;
	} else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Paikka') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY paikka
SQLEND;
	} else if(isset($_GET['jarjestys']) && $_GET['jarjestys'] == 'Hinta') {
		$sql = <<<SQLEND
			SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
			FROM Tapahtuma
			ORDER BY lipunhinta
SQLEND;
	}
	
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Html($stmt) {
	$taso = $_SESSION['taso'];
	$row_count = $stmt->rowCount();
	$col_count  = $stmt->columnCount();

	echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
	echo "<table border='0'>\n";    
	// yläpalkki
	if ($taso >= 2) {
	$output = <<<OUTPUTEND
		<tr bgcolor='#ffeedd'>
			<td>Kuva</td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Tapahtuma'>Tapahtuma</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Ajankohta'>Ajankohta</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Jarjestaja'>Järjestäjä</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Kuvaus'>Kuvaus</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Paikka'>Paikka</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Hinta'>Hinta</a></td>
			<td>Muokkaa</td>
		</tr>
OUTPUTEND;
	} else {
		$output = <<<OUTPUTEND
		<tr bgcolor='#ffeedd'>
			<td>Kuva</td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Tapahtuma'>Tapahtuma</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Ajankohta'>Ajankohta</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Jarjestaja'>Järjestäjä</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Kuvaus'>Kuvaus</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Paikka'>Paikka</a></td>
			<td><a href='tapahtumat_listaa.php?jarjestys=Hinta'>Hinta</a></td>
		</tr>
OUTPUTEND;
}
echo $output;

// tapahtumat
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$taso = $_SESSION['taso'];
    $muokkaus_linkki = "<a href='tapahtumat_muokkauslomake.php?id={$row['tapahtumaID']}'>Muokkaa</a>";
	$tapahtuma_linkki = "<a href='tapahtumat_tapahtumasivu.php?id={$row['tapahtumaID']}'>{$row['nimi']}</a>";
	if ($taso >= 2) {
		$output = <<<OUTPUTEND
			<tr>
				<td><img src="lataaKuva.php?id={$row['tapahtumaID']}" width="50" height="50"></td><td>$tapahtuma_linkki</td><td>{$row['ajankohta']}</td>
				<td>{$row['jarjestaja']}</td><td>{$row['kuvaus']}</td><td>{$row['paikka']}</td>
				<td>{$row['lipunhinta']}</td> <td>$muokkaus_linkki</td>
		   </tr>
OUTPUTEND;
	} else {
		$output = <<<OUTPUTEND
			<tr>
				<td><img src="lataaKuva.php?id={$row['tapahtumaID']}" width="50" height="50"></td><td>$tapahtuma_linkki</td><td>{$row['ajankohta']}</td>
				<td>{$row['jarjestaja']}</td><td>{$row['kuvaus']}</td><td>{$row['paikka']}</td>
				<td>{$row['lipunhinta']}</td>
		   </tr>
OUTPUTEND;
	}
    echo $output;
	
	
}
echo "</table>\n";
echo $_SESSION['taso'];
}

?>
