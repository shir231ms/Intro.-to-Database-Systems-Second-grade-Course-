<?php 
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);

	$sql555="INSERT INTO `favorite`(user_id, recruit_id)"
			."VALUES('".
					 $_POST["userid"].
					 "','".
					 $_POST["like"].
					 "')";
	$sth555=$db->prepare($sql555);
	$sth555->execute();
	//echo $sql555;
	header("location: login_jobseeker.php");
?>
	
