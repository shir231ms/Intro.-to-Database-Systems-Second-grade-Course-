<?php 
	session_save_path("tm");
	session_start();
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
	if($_POST['Account_LIN'] == ""|| $_POST['password_LIN'] == ""){
		echo "Never blank space!!";?>
		<form action="homepage.php">
			<input type="submit" value="Back">
		</form><?php
		session_destroy();
	}
	else{
		$result1 ="SELECT *  FROM `user` "
					."WHERE `account`=? AND `password`=?";
		$sth1= $db->prepare($result1);
		$sth1->execute(array($_POST['Account_LIN'], hash("md5",$_POST['password_LIN'])));
		$daa=$sth1->fetchObject();
		
		if($daa){
			$_SESSION["Account"]=$_POST['Account_LIN'];
			$_SESSION["Password"]=hash("md5",$_POST['password_LIN']);
			header('location: login_jobseeker.php');
		}
		else {
			echo "Error!~Please Login again!!";
			echo '<form action="homepage.php">
					<button type="submit">Back</button></p>';
					session_destroy();
			echo '</form>';
		}
	}
?>