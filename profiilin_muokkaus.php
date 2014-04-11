<style type='text/css'>
tr:nth-child(odd) {background: #ffffff}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffffff}
.content {width:800px; margin:0 auto;}
.btn {margin-top:10px;}
.error {color:red;}
</style>

<?php
//session_start();

$error = '';

include_once('navbar.php');
require_once('db-init.php');


if (isset($_GET['error'])) $error = "Tietojen tallennus epäonnistui, yritä uudestaan. Varmista, että kirjoitat kenttien tiedot oikein.";

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
<div class="content">
<h3 class='error'><?php echo $error ?></h3>
<h3>Muokkaa tietoja:</h3>

<form method='get' action='profiilin_muokkauksen_tallennus.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sähköposti (tunnus)</td>
  <td bgcolor='#D9E2E4'><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>' >
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sukunimi</td>
  <td><input type='text' name='sukunimi' size='30' value='<?php echo $row['sukunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Etunimi</td>
  <td><input type='text' name='etunimi' size='30' value='<?php echo $row['etunimi'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Katuosoite</td>
  <td><input type='text' name='osoite' size='30' value='<?php echo $row['katuosoite'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postinumero</td>
  <td><input type='text' name='postinumero' size='30' value='<?php echo $row['postinumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postitoimipaikka</td>
  <td><input type='text' name='postitoimipaikka' size='30' value='<?php echo $row['postitoimipaikka'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Puhelinnumero</td>
  <td><input type='text' name='puhelinnumero' size='30' value='<?php echo $row['puhelinnumero'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Opiskelijatunnus</td>
  <td><input type='text' name='opiskelijatunnus' size='30' value='<?php echo $row['opiskelijatunnus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Kampus</td>
  <td><input type='text' name='kampus' size='30' value='<?php echo $row['kampus'] ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value='<?php echo $row['lisatiedot'] ?>'></td>
</tr>
</table>
<input type='submit' name='action' value='Tallenna muutokset' class='btn' onclick="javascript: return confirm('Hyväksy tallennus?')">
<input type='submit' name='action' value='Peruuta' class='btn'><br>
</form>
</div>