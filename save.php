<?php 
	session_save_path("tm");
	session_start();
	//echo $_SESSION['Account'];
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
	
	$sqlee="DELETE FROM `result` WHERE `id`=?";
	$sthee=$db->prepare($sqlee);
	$sthee->execute(array($_POST['revise']));

	$sql5="INSERT INTO `result`(id,employer_id,occupation_id,location_id,working_time,education,experience,salary)"
			."VALUES( '". 
					 $_POST['revise'].
					 "' , '".
					 $_POST['emid'].
					 "' , '".
					 $_POST['Occupationid'].
					 "' , '".
					 $_POST['Locationid'].
					 "' , '".
					 $_POST['WT'].
					 "' , '".
					 $_POST['ER'].
					 "' , '".
					 $_POST['MWE'].
					 "' , '".
					 $_POST['ES'].
					 "')";
	$sth5= $db->prepare($sql5);//how to input employerID?
	$sth5->execute();
	//echo $_POST['revise'];
	//echo $sql5;
	header('location: login_employer.php');
?>
	
