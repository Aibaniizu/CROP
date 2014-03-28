<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>

<?php
//session_start();

include_once('navbar.php');
require_once('db-init.php');

$msg = isset($_COOKIE['succeed']) ? $_COOKIE['succeed'] : '';

$getid = 'testi@testi.fi';
$stmt = haeHenkiloKannasta ($db, $getid);
$row=$stmt->fetch(PDO::FETCH_ASSOC);

function haeHenkiloKannasta($db, $getid) {
    $sql = <<<SQLEND
    SELECT sahkoposti, etunimi, sukunimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, opiskelijatunnus, kampus, lisatiedot
    FROM Kayttaja WHERE sahkoposti=:getid
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':getid', "$getid", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

?>
<h1>Hei <?php echo $row['etunimi'] ?>! </h1>
<p><?php echo $msg ?></p>
<form method='get' action='profiilin_ohjaussivu.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Sähköposti (tunnus)</td>
  <td><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Sukunimi</td>
  <td><?php echo $row['sukunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Etunimi</td>
  <td><?php echo $row['etunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Katuosoite</td>
  <td><?php echo $row['katuosoite'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Postinumero</td>
  <td><?php echo $row['postinumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Postitoimipaikka</td>
  <td><?php echo $row['postitoimipaikka'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Puhelinnumero</td>
  <td><?php echo $row['puhelinnumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Opiskelijatunnus</td>
  <td><?php echo $row['opiskelijatunnus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kampus</td>
  <td><?php echo $row['kampus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Lisätiedot</td>
  <td><?php echo $row['lisatiedot'] ?></td>
</tr>
</table>
<input type='submit' name='action' value='Muokkaa tietoja'><br>
<input type='submit' name='action' value='Tilaushistoria'><br>
</form>

<?php
 setcookie('succeed');
?>
