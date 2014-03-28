<form method='get' action='profiilin_tilaushistoria.php'>
<h1>testi</h1>
<?php

$getid = 'testi@testi.fi';
$stmt = haeTilausKannasta ($db, $getid);
$row=$stmt->fetch(PDO::FETCH_ASSOC);

function haeTilausKannasta($db, $getid) {
    $sql = <<<SQLEND
SELECT maksutapa,sukunimi,nimi FROM Asiakkaan_lippu JOIN Tilaus ON (Asiakkaan_lippu.tilausnumero = Tilaus.tilausnumero) JOIN Kayttaja ON (Kayttaja_sahkoposti = Kayttaja.sahkoposti) INNER JOIN Tapahtuma ON (Tapahtuma.tapahtumaID = Asiakkaan_lippu.tapahtumaID) WHERE Kayttaja.sahkoposti='testi@testi.fi'
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':getid', "$getid", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
echo "<table border='0'>\n"; 
/*echo "<tr>";
echo "	<td>Tilausnumero</td><td>Päivämäärä</td><td>Toimitustapa</td>";
echo "    <td>Maksutapa</td>";
echo "	</tr>";
*/
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['maksutapa']}</td><td>{$row['sukunimi']}</td><td>{$row['nimi']}</td>
    
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";

?>
</form>