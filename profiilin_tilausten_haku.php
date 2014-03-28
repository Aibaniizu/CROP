<form method='get' action='profiilin_tilaushistoria.php'>
<h1>testi</h1>
<?php

$getid = 'testi@testi.fi';
$stmt = haeTilausKannasta ($db, $getid);
$row=$stmt->fetch(PDO::FETCH_ASSOC);

function haeTilausKannasta($db, $getid) {
    $sql = <<<SQLEND
SELECT tilausnumero, paivamaara, toimitustapa, maksutapa FROM Kayttaja LEFT JOIN Tilaus ON (sahkoposti = Kayttaja_sahkoposti) WHERE sahkoposti=:getid
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
echo "tere";
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['tilausnumero']}</td><td>{$row['paivamaara']}</td><td>{$row['maksutapa']}</td>
    
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";

?>
</form>