<style type='text/css'>
tr:nth-child(odd) {background: #AABBBF}
tr:nth-child(even) {background: #D9E2E4}
tr:nth-child(1) {background: #AABBBF}
.tilaushistoria {width: 900px}
.btn {margin-top:10px;}
</style>

<form method='get' action='profiili_listaus.php'>

<?php

$getid = $_GET['id'];
$stmt = haeTilausKannasta ($db, $getid);

function haeTilausKannasta($db, $getid) {
    $sql = <<<SQLEND
 SELECT Tilaus.tilausnumero, nimi, ajankohta, lipunhinta, paikka, jarjestaja, maksutapa, toimitustapa FROM Tilaus LEFT JOIN Asiakkaan_lippu ON (Tilaus.tilausnumero = Asiakkaan_lippu.tilausnumero) LEFT JOIN Tapahtuma ON (Asiakkaan_lippu.tapahtumaID = Tapahtuma.tapahtumaID) WHERE Kayttaja_sahkoposti=:getid
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':getid', "$getid", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

echo "<table border='0' class='tilaushistoria'>\n"; 
echo "<tr>";
echo "<td><b>Tilausnumero</b></td><td><b>Tapahtuma</b></td><td><b>Ajankohta</b></td><td><b>Paikka</b></td>";
echo "<td><b>Järjestäjä</b></td><td><b>Maksutapa  </b></td><td><b>Toimitustapa</b></td>";
echo "</tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['tilausnumero']}  </td><td>{$row['nimi']}  </td><td>{$row['ajankohta']}  </td><td>{$row['paikka']}  </td><td>{$row['jarjestaja']}  </td>
    <td>{$row['maksutapa']}  </td><td>{$row['toimitustapa']}  </td>
   </tr>
OUTPUTEND;
    echo $output;

}
echo "</table>\n";

?>
<input type='submit' name='action' value='Peruuta' class='btn'><br>
</form>