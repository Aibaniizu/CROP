<?php
//session_start();
require_once('db-init.php'); 
include_once('navbar.php');



//muuuttujat talteen linkista
$getid = $_GET['id'];
$getfname = $_GET['etunimi'];
$getlname = $_GET['sukunimi'];
$getaddr = $_GET['osoite'];
$getpostnmb = $_GET['postinumero'];
$getpostplace = $_GET['postitoimipaikka'];
$getphone = $_GET['puhelinnumero'];
$getuid = $_GET['opiskelijatunnus'];
$getcampus = $_GET['kampus'];
$getinfo = $_GET['lisatiedot'];

if ($_GET['action'] == 'Peruuta') {
   header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tiedot.php?id=".$getid);

}

//tarkistukset onko lomakkeen tiedot oikein
if (preg_match("/^[0-9]{5}$/", $getpostnmb) 
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getfname) 
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getlname)
	AND preg_match("/^((\+358 ?)|0)(40 ?[0-9]{3}( [0-9]{3} ?[0-9]{1}|[0-9]{3}[0-9]{1}))$/", $getphone)
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å]+$/",$getpostplace)
	AND preg_match("/^[a-z,A-Z,ö,ä,å,Ö,Ä,Å, 0-9]+$/",$getaddr)) {
    


$stmt = tallennaKantaan($db, $getid, $getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getinfo);
$stmt2 = haekannasta($db, $getid);
$row=$stmt2->fetch(PDO::FETCH_ASSOC);

} else {
   header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_muokkaus.php?id=".$getid."&error=virhe");
	
} 
 
function tallennaKantaan($db, $getid, $getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getinfo) {
    $sql = <<<SQLEND
    UPDATE Kayttaja SET etunimi=?, sukunimi=?, katuosoite=?, postinumero=?, postitoimipaikka=?, puhelinnumero=?, opiskelijatunnus=?, kampus=?, lisatiedot=? WHERE sahkoposti=?
SQLEND;
     
   $stmt = $db->prepare("$sql");
   $stmt->execute(array($getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getinfo, $getid));
   return $stmt;    
}
 
function haekannasta($db, $getid) {
   $sql = <<<SQLEND
   SELECT sahkoposti, etunimi, sukunimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, opiskelijatunnus, kampus, lisatiedot
    FROM Kayttaja WHERE sahkoposti=:getid
SQLEND;
 
   $stmt2 = $db->prepare("$sql");
   $stmt2->bindValue(':getid', "$getid", PDO::PARAM_STR);
   $stmt2->execute();
   return $stmt2;    
}


/*header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "profiilin_tiedot.php"); */

 
?>

<style type='text/css'>
tr:nth-child(odd) {background: #AABBBF}
tr:nth-child(even) {background: #D9E2E4}
tr:nth-child(1) {background: #AABBBF}
.content {width:800px; margin:0 auto;}
.tieto {width:150px;}
</style>

<div class='content'>
<h3>Tietosi tallennettiin onnistuneesti! </h3>

<form method='get' action='profiilin_ohjaussivu.php'> 
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sähköposti (tunnus)</td>
  <td class='tieto'><?php echo $row['sahkoposti'] ?></td>
  <input type='hidden' name='id' size='30' value='<?php echo $row['sahkoposti'] ?>'>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Sukunimi</td>
  <td><?php echo $row['sukunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Etunimi</td>
  <td><?php echo $row['etunimi'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Katuosoite</td>
  <td><?php echo $row['katuosoite'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postinumero</td>
  <td><?php echo $row['postinumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Postitoimipaikka</td>
  <td><?php echo $row['postitoimipaikka'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Puhelinnumero</td>
  <td><?php echo $row['puhelinnumero'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Opiskelijatunnus</td>
  <td><?php echo $row['opiskelijatunnus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Kampus</td>
  <td><?php echo $row['kampus'] ?></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#D9E2E4'>Lisätiedot</td>
  <td><?php echo $row['lisatiedot'] ?></td>
</tr>

<input type='submit' name='action' value='Jatka'/>

</form>
</div>