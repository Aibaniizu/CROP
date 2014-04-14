<style type='text/css'>
tr:nth-child(odd) {background: #749FA9}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #749FA9}
</style>

<?php
include_once('navbar.php');
require_once('db-init.php');
?>
<h1>Tulleet tilaukset</h1>
<?php
echo "<table border='0'>\n";    
$stmt = haeLippu($db);
printLippu($stmt, $db);
 



function haeLippu($db) {
   $sql = <<<SQLEND
   SELECT *
   FROM Asiakkaan_lippu
SQLEND;

   $stmt = $db->prepare("$sql");
   $stmt->execute();
   return $stmt;    
}

function printLippu($stmt, $db) {

$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();

echo "Hakutulokset:" . $row_count. " riviä:<hr>\n"; 
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>Lippunumero</td><td>Tilausnumero</td><td>TaphtumaID</td><td>Tilaus PVM</td><td>Toimitustpa</td>
<td>Maksutapa</td><td>Lisätiedot</td><td>Kayttaja_sahkoposti</td>
</tr>
OUTPUTEND;
echo $output;

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

	
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['LippuNro']}</td><td>{$row['tilausnumero']}</td><td>{$row['tapahtumaID']}</td>
OUTPUTEND;
    echo $output;
	$tilausnumero = $row['tilausnumero'];
	haeTilaukset($db, $tilausnumero);
	
}
}



function haeTilaukset($db, $tilausnumero) {
   $sql = <<<SQLEND
   SELECT *
   FROM Tilaus WHERE tilausnumero=$tilausnumero
SQLEND;

   $stmt = $db->prepare("$sql");
   $stmt->execute();
   printTilaus($stmt);   
}

function printTilaus($stmt) {

$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();
    

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

	
    $output = <<<OUTPUTEND
    <td>{$row['paivamaara']}</td><td>{$row['toimitustapa']}</td>
    <td>{$row['maksutapa']}</td><td>{$row['lisatiedot']}</td><td>{$row['Kayttaja_sahkoposti']}</td></tr>
OUTPUTEND;
    echo $output;

	
}

}
echo "</table>\n";

function printGraafi(){
echo '<img src="tilaukset_graafi.php"> ';
}