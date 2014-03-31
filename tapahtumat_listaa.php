<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>

<?php
// mysql-pdo-search.php

require_once('db-init.php');
include_once('navbar.php');

$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
    
$stmt = haeTapahtumat($db, $hakuehto);
sqlResult2Html($stmt);

// 
function haeTapahtumat($db, $hakuehto) {
   $sql = <<<SQLEND
   SELECT tapahtumaID, nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, lippukiintio, lippuostorajoitus, kuva, lisatiedot
   FROM Tapahtuma WHERE tapahtumaID
   LIKE :hakuehto
SQLEND;

   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Html($stmt) {

$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();

echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
echo "<table border='0'>\n";    
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>TapahtumaID</td><td>Tapahtuma</td><td>Ajankohta</td>
<td>Järjestäjä</td><td>Kuvaus</td><td>Paikka</td><td>Hinta</td>
</tr>
OUTPUTEND;
echo $output;

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $muokkaus_linkki = "<a href='tapahtumat_muokkauslomake.php?id={$row['tapahtumaID']}'>{$row['tapahtumaID']}</a>";
	$tapahtuma_linkki = "<a href='tapahtumat_tapahtumasivu.php?id={$row['tapahtumaID']}'>{$row['nimi']}</a>";
	$output = <<<OUTPUTEND
    <tr>
    <td>$muokkaus_linkki</td><td>$tapahtuma_linkki</td><td>{$row['ajankohta']}</td>
    <td>{$row['jarjestaja']}</td><td>{$row['kuvaus']}</td><td>{$row['paikka']}</td>
	<td>{$row['lipunhinta']}</td>
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";
}

?>