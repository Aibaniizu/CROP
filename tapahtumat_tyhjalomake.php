<?php
	require_once('db-init.php');
	include_once('navbar.php');
	include_once('navbar_tapahtumat.php');
	include_once('tapahtumat_lisaa.php');
	
$forms = <<<FORMSEND
<form method='post'  enctype="multipart/form-data" action='tapahtumat_tyhjalomake.php'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Tapahtuman nimi</td>
  <td><input type='text' name='nimi' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Ajankohta</td>
  <td><input type='text' name='ajankohta' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Järjestäjä</td>
  <td><input type='text' name='jarjestaja' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kuvaus</td>
  <td><input type='text' name='kuvaus' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Paikka</td>
  <td><input type='text' name='paikka' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Hinta</td>
  <td><input type='text' name='lipunhinta' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Kiintiö</td>
  <td><input type='text' name='lippukiintio' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Ostorajoitus</td>
  <td><input type='text' name='lippuostorajoitus' size='30' value='' required></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#749FA9'>Lisätiedot</td>
  <td><input type='text' name='lisatiedot' size='30' value=''></td>
</tr>
<tr valign='top'>
	<td align='right' bgcolor='#749FA9'>Kuva</td>
	<td><input type="file" name="kuva"></td>
	Huom! Kuvan tulee olla 150x150px ||  Anna päiväys muodossa vvvv-kk-pp
</tr>
</table>
<input type='submit' name='tallenna' value='Tallenna' ><br>
</form>

FORMSEND;

echo $forms;

?>

