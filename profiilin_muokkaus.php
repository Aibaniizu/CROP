<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>

<?php
include_once('navbar.php');
require_once('db-init.php');

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
<h1>Muokkaa tietoja:</h1>
<form method='get' action='profiilin_muokkauksen_tallennus.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Sähköposti (tunnus)</td>
  <td><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Sukunimi</td>
  <td><input type='text' name='sukunimi' size='30' value='<?php echo $row['sukunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Etunimi</td>
  <td><input type='text' name='etunimi' size='30' value='<?php echo $row['etunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Katuosoite</td>
  <td><input type='text' name='osoite' size='30' value='<?php echo $row['katuosoite'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Postinumero</td>
  <td><input type='text' name='postinumero' size='30' value='<?php echo $row['postinumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Postitoimipaikka</td>
  <td><input type='text' name='postitoimipaikka' size='30' value='<?php echo $row['postitoimipaikka'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Puhelinnumero</td>
  <td><input type='text' name='puhelinnumero' size='30' value='<?php echo $row['puhelinnumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Opiskelijatunnus</td>
  <td><input type='text' name='opiskelijatunnus' size='30' value='<?php echo $row['opiskelijatunnus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kampus</td>
  <td><input type='text' name='kampus' size='30' value='<?php echo $row['kampus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value='<?php echo $row['lisatiedot'] ?>'></td>
</tr>
</table>
<input type='submit' name='action' value='Tallenna muutokset' onclick="javascript: return confirm('Hyväksy tallennus?')"><br>
</form>
