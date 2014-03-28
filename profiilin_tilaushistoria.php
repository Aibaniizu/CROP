<?php
require_once('db-init.php'); 
include_once('navbar.php');
/*
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
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['tilausnumero']}</a></td><td>{$row['paivamaara']}</td><td>{$row['toimitustapa']}</td>
    <td>{$row['maksutapa']}</td>
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";
*/


?>
<h1> Tilaushistoria </h1>

<table border='0' cellpadding='5'>
<?php include_once ('profiilin_tilausten_haku.php');?>
</table>