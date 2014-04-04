<?php 
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     
$stmt = haeTapahtumat($db, $hakuehto);
listaaTulokset($stmt);
 
function haeTapahtumat($db, $hakuehto) {
   $sql = <<<SQLEND
   SELECT nimi, ajankohta, jarjestaja, kuvaus, paikka, lipunhinta, kuva
   FROM Tapahtuma WHERE nimi
   LIKE :hakuehto
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 
// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function listaaTulokset($stmt) {
 
$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();
 
echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
echo "<table border='0'>\n";    
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>Kuva</td><td>Tapahtuma</td><td>Ajankohta</td>
<td>Järjestäjä</td><td>Kuvaus</td><td>Paikka</td><td>Hinta</td>
</tr>
OUTPUTEND;
echo $output;
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $linkki = "<a href='tapahtumat_tapahtumasivu.php?id={$row['nimi']}'>{$row['nimi']}</a>";
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['kuva']}</td><td>$linkki</td><td>{$row['ajankohta']}</td>
    <td>{$row['jarjestaja']}</td><td>{$row['kuvaus']}</td><td>{$row['paikka']}</td><td>{$row['lipunhinta']}</td>
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";
}
?>