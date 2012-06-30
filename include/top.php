<?php 
session_start();
include("../include/global.php");
include("../include/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../css/main.css"/>
<script src="../scripts/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
function validate(form){
	var regExp = /^[0-9]$/;
	var telefonvalid = "yes";
	var msg = "";
	if(form.korisnik.value == "") msg += " - Vnesite Ime i Prezime\n";
	if(form.korisnik_telefon.value == "")	msg += " - Vnesite Telefon\n"
		else {
		var telefon =  form.korisnik_telefon.value;
		for(var i = 0; i < form.korisnik_telefon.value.length; i++)
          { 
            if (!telefon.charAt(i).match(regExp))
            {
              var telefonvalid = "no";
            }
          };
		 };
	if(telefonvalid=="no")
		 msg+=" - Vnesite Validan Telefon\n";
	if(msg=="") 
	{
		return true;
	}
	else
	{
		alert(msg);
		return false;
	}
};
</script>
<title>PXD rezervacije</title>
</head>

<body>
<div id="header">
<div id="menu">
<ul>
            <li>
            <a <?php if($current=="Danas") echo 'id="active"'?> href="../danas/index.php">Danas</a>
            </li>
            <li>
            <a <?php if($current=="Mesec")  echo 'id="active"'?>href="../mesec/index.php">Mesec</a>
            </li>
            <li>
            <a <?php if($current=="Dan") echo 'id="active"'?>href="../dan/index.php">Dan</a>
            </li>
            <li>
            <a <?php if($current=="Lista") echo 'id="active"'?>href="../lista/index.php">Lista</a>
            </li>
            </ul>
</div>
</div>
<div id="main">