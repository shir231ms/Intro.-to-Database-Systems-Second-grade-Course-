<?php
	session_save_path("tm");
	session_start();
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
	if($_POST['Account'] == " "|| $_POST['Password'] == " ")echo "Never blank space!!";
	else{
		$sql6="SELECT * FROM `employer`
				WHERE `account`=?";
		$sth6=$db->prepare($sql6);
		$sth6->execute(array($_POST['Account']));
		$result6=$sth6->fetchObject();
	
		if($result6){
			echo "This Account exists~<br>Please rename your new Account.";
			echo '<form action="signup_employer.php">
				 <button type="submit">Back</button></p>';
				 session_destroy();
			echo '</form>';
		}
		else {
			$sql2="INSERT INTO `employer`(account,password,phone,mail)"
				."VALUES('".
						$_POST['Account'].
						"' , '".
						hash("md5",$_POST['Password']).
						"' , '".
						$_POST['Phone number'].
						"' , '".
						$_POST['Email'].
						"') ";
			$sth2= $db->query($sql2);
			$sth2->execute();
			$_SESSION['Account']=$_POST['Account'];
			$_SESSION['Password']=hash("md5",$_POST['Password']);
			header('location: login_employer.php');
		}
	}
?>