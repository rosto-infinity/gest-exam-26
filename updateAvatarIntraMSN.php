<?php
$img=$_POST["nb"];
$id=$_POST["id"];
include_once("./common/config.inc.php");
include_once("./librairie_php/db_triade.php");
$cnx=cnx();
$imgID=recupImageIntraMSN($id);
updateImageIntraMsn($img,$id);
?>
