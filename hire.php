<?php 
	session_save_path("tm");
	session_start();
	
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
	
	$sql="DELETE FROM `application` WHERE `recruit_id`=?";
	$sth=$db->prepare($sql);
	$sth->execute(array($_POST["hire_resultid"]));
	
	$sql2="DELETE FROM `result` WHERE `id`=?";
	$sth2=$db->prepare($sql2);
	$sth2->execute(array($_POST["hire_resultid"]));
	
	//echo $_POST["hire_resultid"];
	header("location: app_list.php");
?>