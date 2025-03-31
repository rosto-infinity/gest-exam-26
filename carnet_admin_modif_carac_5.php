<?php
session_start();
/***************************************************************************
 *                              T.R.I.A.D.E.
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) S.A.R.L. T.R.I.A.D.E. 
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
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom] "?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php 
include_once("./librairie_php/lib_licence.php"); 
include_once("./librairie_php/db_triade.php"); 
validerequete("menuadmin");
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Modification du Carnet de Suivi" ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td valign=top>
<!-- // fin  -->
<br><br>
<?php 

$idcarnet=$_POST["idcarnet"];
$nom_carnet=$_POST["saisie_nom_carnet"];
$code_lettre=$_POST["code_lettre"];
$code_chiffre=$_POST["code_chiffre"];
$code_couleur=$_POST["code_couleur"];
$code_julesverne=$_POST["code_julesverne"];
$code_commentaire=$_POST["code_commentaire"];
$code_note=$_POST["code_note"];
$nb_periode=$_POST["saisie_nb_periode"];
$section=$_POST["section"];


for($i=0;$i<4;$i++) {
	$nb=$_POST["ordre"][$i];
	$tab[$nb]=$section[$i];
}



$cnx=cnx();
modif_carnet($idcarnet,$nom_carnet,$code_lettre,$code_chiffre,$code_couleur,$code_note,$tab,$nb_periode,$code_julesverne,$code_commentaire);
Pgclose();
?>

<form action='carnet_admin_competence.php' method="post">
<table border=0 align=center width=85%>
<tr><td align="left" colspan=2><font class="T2">Carnet de suivi modifié.  </font><br /><br /></td></tr>
<tr><td align=center colspan="2"><br />
<table><tr><td>
<script language=JavaScript>buttonMagic("<?php print "Retour Gestion Carnet de Suivi" ?>","carnet_admin.php","_parent","","");</script>
<script language=JavaScript>buttonMagicSubmit("<?php print "Ajouter une compétence" ?>","rien"); //text,nomInput</script>&nbsp;&nbsp;</td></tr></table>
</td></tr>
</table><br /><br />
</form>


<!-- // fin  -->
</td></tr></table>

<?php
       // Test du membre pour savoir quel fichier JS je dois executer
       if ($_SESSION[membre] == "menuadmin") :
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
