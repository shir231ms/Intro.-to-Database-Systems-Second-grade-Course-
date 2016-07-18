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
	
	if( ! isset( $_SESSION['Account'] ) )
		header( 'Location: homepage.php' );
	else{
	
	
	$sql="SELECT * FROM `employer`"."WHERE `account`=?";
	$sth=$db->prepare($sql);
	$sth->execute(array($_SESSION['Account']));
	$result=$sth->fetchObject();
	$sql4="INSERT INTO `result`(employer_id,occupation_id,location_id,working_time,education,experience,salary)"
		   ."VALUES('".$result->id."' ,
					'".$_POST['Occupationid']."',
					'".$_POST['Locationid']."',
					'".$_POST['WT']."',
					'".$_POST['ER']."',
					'".$_POST['MWE']."',
					'".$_POST['ES']."')";
	$sth4= $db->prepare($sql4);
	$re = $sth4->execute();
	//echo $sql4;
	header('location: login_employer.php');
}?>