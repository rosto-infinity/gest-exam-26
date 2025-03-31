<?php
session_start();
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - 
 *   Site                 : http://www.triade-educ.com
 *
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/acces.js"></script>
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/lib_absrtdplanifier.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom]" ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php include("./librairie_php/lib_licence.php");
// connexion (après include_once lib_licence.php obligatoirement)
include_once("librairie_php/db_triade.php");
include_once("librairie_php/timezone.php");
validerequete("3");
$cnx=cnx();
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]".".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]"."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGABS25?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<!-- // fin  -->
<BR><center><font class=T2><B> <?php print LANGABS28?></B></font></center><BR><BR>
<?php if ($_SESSION["membre"] == "menuprof") { ?>
	<form method="post" action="retardprof.php">
<?php }else{ ?>
	<form method="post" action="gestion_abs_retard_codebar.php">
<?php } ?>
<table align="center" border=0 ><tr><td align="center" >
<script language=JavaScript>buttonMagicSubmit("Autres absences","");</script>
</td></tr></table>
</form>
<br><br><br>
<?php
$idmatiere=$_POST["idmatiere"];
$motif="type_abs";
$id=$_POST["ideleve"];

for ($i=0;$i<count($id);$i++) {
	$heure="saisie_heure";
	$duree="";
	$duree1="saisie_duree1_".$i;
	$pers=$id[$i];
	$raison="0";
/*	
	print "<BR>a)";
	print $_POST[$motif];
	print "<BR>b)";
	print $_POST[$heure];
	print "<BR>c)";
	print $_POST[$duree];
	print "<BR>d)";
	print $pers;
	print "<BR>e)";
	print "Par ".$_SESSION["nom"];
	print "<BR>f)";
	print $_POST["idmatiere"];
	print "<BR>g)";
	print $_POST["idprof"];
 */
	$justifier=0;
	list($horaireLibelle,$heure,$horaireFin)=preg_split('/#/',$_POST[$heure]);
	$creneaux="$horaireLibelle#".timeForm($heure)."#".timeForm($horaireFin);
	$dureeIntA=diffheure($heure,$horaireFin);

	list($dureeInt,$null)=preg_split("/:/",$dureeIntA);
	$refRattrapage="";
	
	if ($_POST["type_abs"] == "retard" ) {
		if ($idmatiere == "") { $idmatiere="-1"; }
		$cr=create_retard($heure,$_POST[$duree],$_POST["datedepart"],$pers,dateDMY2(),$_SESSION["nom"],$_POST[$raison],$idmatiere,$justifier,$_POST["idprof"],$creneaux);
        	if($cr == 1){
			history_cmd($_SESSION["nom"],"RTD","enr. via Vie Scolaire");
	        }else {
	       		print "&nbsp;&nbsp;- ".LANGacce1." ".recherche_eleve_nom($_POST[$pers])." ".recherche_eleve_prenom($_POST[$pers])." ".LANGABS55.".<br>";
        	}
	}
	if ($_POST["type_abs"] == "absent" ) {
		// $duree,$date,$saisie_pers,$date_saisie,$user,$motif,$idmatiere,$justifier,$heuredabsence,$idprof,$creneaux
		$cr=create_absent("${dureeInt}H",$_POST["datedepart"],$pers,dateDMY2(),$_SESSION["nom"],"",$idmatiere,$justifier,timeForm($heure),$_POST["idprof"],$creneaux,$refRattrapage);
		if($cr == 1){
			history_cmd($_SESSION["nom"],"ABS","enr. via Vie Scolaire");
		}else {
		        print "&nbsp;&nbsp;- ".LANGacce1." ".recherche_eleve_nom($_POST[$pers])." ".recherche_eleve_prenom($_POST[$pers])." ".LANGABS54.".<br>";
		}
	}
}

Pgclose();
?>

     <!-- // fin  -->
     </td></tr></table>
     <?php
       // Test du membre pour savoir quel fichier JS je dois executer
   if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")):
       print "<SCRIPT language='JavaScript' ";
       print "src='./librairie_js/".$_SESSION[membre]."2.js'>";
       print "</SCRIPT>";
   else :
      print "<SCRIPT language='JavaScript' ";
      print "src='./librairie_js/".$_SESSION[membre]."22.js'>";
      print "</SCRIPT>";

      top_d();

      print "<SCRIPT language='JavaScript' ";
     print "src='./librairie_js/".$_SESSION[membre]."33.js'>";
     print "</SCRIPT>";

       endif ;
     ?>
   </BODY></HTML>
