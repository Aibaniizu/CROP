<?php 
require_once('db-init.php');
include_once('navbar.php');

//otetaan muuttujat jos on laitettu, eli tullaan virhetilanteesta
$error ="";
if (isset($_GET['errori'])) $error = "Tietojen tallennus epäonnistui, yritä uudestaan. Varmista, että kirjoitat kenttien tiedot oikein.";

$getid = isset($_GET['id']) ? $_GET['id'] : "";
$getfname = isset($_GET['etunimi']) ? $_GET['etunimi'] : "";
$getlname = isset($_GET['sukunimi']) ? $_GET['sukunimi'] : "";
$getaddr = isset($_GET['osoite']) ? $_GET['osoite'] : "";
$getpostnmb = isset($_GET['postinumero']) ? $_GET['postinumero'] : "";
$getpostplace = isset($_GET['postitoimipaikka']) ? $_GET['postitoimipaikka'] : "";
$getphone = isset($_GET['puhelinnumero']) ? $_GET['puhelinnumero'] : "";
$getuid = isset($_GET['opiskelijatunnus']) ? $_GET['opiskelijatunnus'] : "";
$getcampus = isset($_GET['kampus']) ? $_GET['kampus'] : "";


?>

<style type='text/css'>
tr:nth-child(odd) {background: #ffffff}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffffff}
</style>
 <h3> Rekisteröidy </h3>
 <p><b><?php echo $error ?></b></p>
 <p>Täytä alla oleva kaavake ja pääset ostamaan lippuja. Tähdellä merkityt kentät ovat pakollisia. Sähköpostiosoitteesi toimii käyttäjätunnuksena. </p>
<form method='get' action='rekisteroityminen-tallennus.php'> <!-- mika tulee actioniin? -->
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sähköposti (tunnus)*</td>
  <td><input type='text' name='id' size='30' value='<?php echo $getid ?>' required ></td>
</tr> 
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sukunimi *</td>
  <td><input type='text' name='sukunimi' size='30' value='<?php echo $getlname ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Etunimi *</td>
  <td><input type='text' name='etunimi' size='30' value='<?php echo $getfname ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Katuosoite *</td>
  <td><input type='text' name='osoite' size='30' value='<?php echo $getaddr ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postinumero *</td>
  <td><input type='text' name='postinumero' size='30' value='<?php echo $getpostnmb ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postitoimipaikka *</td>
  <td><input type='text' name='postitoimipaikka' size='30' value='<?php echo $getpostplace ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Puhelinnumero *</td>
  <td><input type='text' name='puhelinnumero' size='30' value='<?php echo $getphone ?>' required ></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Opiskelijatunnus</td>
  <td><input type='text' name='opiskelijatunnus' size='30' value='<?php echo $getuid ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Kampus</td>
  <td><input type='text' name='kampus' size='30' value='<?php echo $getcampus ?>'></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4' >Salasana *</td>
  <td><input type='text' name='salasana' size='30' value='' required ></td>
</tr>
<!-- JOS INTO RIITTÄÄ NIIN SALASANAN VAHVISTUS JA MUUTENKIN VAHVISTUS! -->
</table>
<input type='submit' name='action' value='Rekisteröidy'><br>
</form>