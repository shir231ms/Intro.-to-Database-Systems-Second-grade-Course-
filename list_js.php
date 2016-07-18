<?php
	session_save_path("tm");
	session_start();
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
?>	
<?php
if( !isset( $_SESSION['Account'])  )
		header( 'Location: homepage.php' );
else{
	echo "Hello ";
	echo $_SESSION["Account"];
	echo "!!";
?>
<form action="logout.php">
	<button type="submit">Logout</button></p>
</form>
<table style="width:100%">
	<tr><th>~~~~~Job Seeker List~~~~~</th></tr>
</table>
<table style="width:100%">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Expected Salary</th>
		<th>Phone Number</th>
		<th>Email</th>
		<th>Specialty</th>
	</tr>
	<tr><form action="login_employer.php">
		<?php
		$result3=$db->query("SELECT * FROM `user`");
		while($data = $result3->fetchObject()){?>
			<tr>
				<th><?php echo $data->id;?></th>
				<th><?php echo $data->account;?></th>
				<th><?php echo $data->gender;?></th>
				<th><?php echo $data->age;?></th>
				<th><?php echo $data->expected_salary;?></th>
				<th><?php echo $data->phone;?></th>
				<th><?php echo $data->email;?></th>
				<th><?php
					$sql="SELECT * FROM `user_specialty`"
							."WHERE `user_id`=?";
					$sth=$db->prepare($sql);
					$sth->execute(array($data->id));
					while($da = $sth->fetchObject()){
						$sql3="SELECT * FROM `specialty`"
								."	WHERE `id`=?";
						$sth5=$db->prepare($sql3);
						$sth5 ->execute(array($da->specialty_id));
						$dat=$sth5->fetchObject();
						echo $dat->specialty;
						echo ",<br>";
					}?>
				</th>
			</tr>
			<?php }	?>
</table></p>
	<button type="submit">Back</button></p>	 
</form>
<?php }?>