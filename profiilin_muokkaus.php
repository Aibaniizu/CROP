<style type='text/css'>
tr:nth-child(odd) {background: #749FA9}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #749FA9}
</style>

<?php
session_start();

$msg = isset($_SESSION['succeed']) ? $_SESSION['succeed'] : 'kissa';
$error = '';

include_once('navbar.php');
require_once('db-init.php');


if (isset($_GET['error'])) $error = "Tietojen tallennus epäonnistui, yritä uudestaan. ";

$getid = $_GET['id'];
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
<h3><?php echo $error ?></h3>
<h1>Muokkaa tietoja:</h1>

<form method='get' action='profiilin_muokkauksen_tallennus.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Sähköposti (tunnus)</td>
  <td><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Sukunimi</td>
  <td><input type='text' name='sukunimi' size='30' value='<?php echo $row['sukunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Etunimi</td>
  <td><input type='text' name='etunimi' size='30' value='<?php echo $row['etunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Katuosoite</td>
  <td><input type='text' name='osoite' size='30' value='<?php echo $row['katuosoite'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Postinumero</td>
  <td><input type='text' name='postinumero' size='30' value='<?php echo $row['postinumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Postitoimipaikka</td>
  <td><input type='text' name='postitoimipaikka' size='30' value='<?php echo $row['postitoimipaikka'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Puhelinnumero</td>
  <td><input type='text' name='puhelinnumero' size='30' value='<?php echo $row['puhelinnumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Opiskelijatunnus</td>
  <td><input type='text' name='opiskelijatunnus' size='30' value='<?php echo $row['opiskelijatunnus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kampus</td>
  <td><input type='text' name='kampus' size='30' value='<?php echo $row['kampus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value='<?php echo $row['lisatiedot'] ?>'></td>
</tr>
</table>
<input type='submit' name='action' value='Tallenna muutokset' onclick="javascript: return confirm('Hyväksy tallennus?')"><br>
<input type='submit' name='action' value='Peruuta'><br>
</form>
