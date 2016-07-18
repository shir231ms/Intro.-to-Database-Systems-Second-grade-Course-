<?php 
	session_save_path("tm");
	session_start();
	//echo $_POST['revise'];
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
	
	$sqlee="DELETE FROM `favorite`"."WHERE `recruit_id`=?";
	$sthee=$db->prepare($sqlee);
	$sthee->execute(array($_POST['del_id']));
	
	header('location: favorite.php');
?>				