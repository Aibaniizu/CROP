<?php
// $_GET['id'] tietoa haetaan
require_once('db-init.php'); //require jos ohjelman ei haluta jatkavat jos ei onnistu ottamaan "yhteytta"
include_once('navbar.php');
 
//muuuttujat talteen linkista
$getid = $_GET['id'];
//$getemail = $_GET['sahkoposti'];
$getfname = $_GET['etunimi'];
$getlname = $_GET['sukunimi'];
$getaddr = $_GET['osoite'];
$getpostnmb = $_GET['postinumero'];
$getpostplace = $_GET['postitoimipaikka'];
$getphone = $_GET['puhelinnumero'];
$getuid = $_GET['opiskelijatunnus'];
$getcampus = $_GET['kampus'];
$getinfo = $_GET['lisatiedot'];
 
$stmt = tallennaKantaan($db, $getid, $getfname, $getlname, $getaddr, $getpostnmb, $getpostplace, $getphone, $getuid, $getcampus, $getinfo);
$stmt2 = haekannasta($db, $getid);
$row=$stmt2->fetch(PDO::FETCH_ASSOC);
 
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
 
?>

<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>

<h1>Tietosi tallennettiin onnistuneesti! </h1>
<form method='get' action=''> 
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

</form>