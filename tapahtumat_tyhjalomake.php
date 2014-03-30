<?php
	require_once('db-init.php');
	include_once('navbar.php');
	include_once('tapahtumat_lisaa.php');
	
$forms = <<<FORMSEND
<form method='post'  enctype="multipart/form-data" action='tapahtumat_tyhjalomake.php'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Tapahtuman nimi</td>
  <td><input type='text' name='nimi' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Ajankohta</td>
  <td><input type='text' name='ajankohta' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Järjestäjä</td>
  <td><input type='text' name='jarjestaja' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kuvaus</td>
  <td><input type='text' name='kuvaus' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Paikka</td>
  <td><input type='text' name='paikka' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Hinta</td>
  <td><input type='text' name='lipunhinta' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kiintiö</td>
  <td><input type='text' name='lippukiintio' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Ostorajoitus</td>
  <td><input type='text' name='lippuostorajoitus' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value=''></td>
</tr>
<tr valign='top'>
	<td align='right' bgcolor='#ffeedd'>Kuva</td>
	<td><input type="file" name="kuva"></td>
</tr>
</table>
<input type='submit' name='tallenna' value='Tallenna' ><br>
</form>

FORMSEND;

echo $forms;

?>

