<?php //kirjaudu_sisaan.php
//session_start();
require_once('db-init.php');
include_once('navbar.php');
//$tunnus = $_POST['tunnus'];
//$salasana = $_POST['salasana'];

if (isset($_POST['tunnus']) AND isset($_POST['salasana'])) {
   $tunnus = $_POST['tunnus'];
   $salasana = $_POST['salasana'];

   $sql = <<<SQLEND
   SELECT sahkoposti, salasana
   FROM Kayttaja
   WHERE sahkoposti = :tunnus AND salasana = :salasana;
SQLEND;

   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':tunnus', "$tunnus", PDO::PARAM_STR);
   $stmt->bindValue(':salasana', "$salasana", PDO::PARAM_STR);
   $stmt->execute();   
   $affected_rows = $stmt->rowCount();
    
    if ($affected_rows == 1) {

        $_SESSION['kirjautunut'] = true;
        $_SESSION['tunnus'] = $_POST['tunnus'];
         header("Location: http://" . $_SERVER['HTTP_HOST']
                                    . dirname($_SERVER['PHP_SELF']) . '/'
                                    . "profiilin_tiedot.php?tunnus=".$tunnus);
        exit;
    } else {
        $_SESSION['errmsg'] = '<span style="background: yellow;">Tunnus/Salasana väärin!</span>';
    }
}


?>

<h1>Kirjautuminen epäonnistui</h1>

<?php echo $_SESSION['errmsg']?>
