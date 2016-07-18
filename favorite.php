<?php 
	session_save_path("tm");
	session_start(); 
?>
<?php
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
	echo "!!";?>
	<form action="logout.php">
		<button type="submit">Logout</button></p>
	</form>
	<!-- define table -->
	<table style="width:100%">
		<tr><th>~~~~~Favorite List~~~~~</th></tr>
	</table>
	<!-- define table -->
	<table style="width:100%">
		<tr>
			<th>ID</th>
			<th>Occupation</th>
			<th>Location</th>
			<th>Work Time</th>
			<th>Education Required</th>
			<th>Minimum of Working Experience</th>
			<th>Salary Per Month</th>
			<th>Operation</th>
		</tr>
		<?php 
			//JOIN SQL 
			$sql666="SELECT favorite.user_id, favorite.recruit_id, result.id,
					result.occupation_id, result.location_id, result.working_time, result.education, result.experience, result.salary
					FROM `result` INNER JOIN `favorite` ON result.id=favorite.recruit_id";
			$sth666=$db->prepare($sql666);
			$sth666->execute();
			while($data666=$sth666->fetchObject()){
				$sql1="SELECT * FROM `occupation`"
									."WHERE `id`=?";//
				$sth1=$db->prepare($sql1);//
				$sth1->execute(array($data666->occupation_id));//
				$data1=$sth1->fetchObject();//
				$sql2="SELECT * FROM `location`"
						."WHERE `id`=?";
				$sth2=$db->prepare($sql2);
				$sth2->execute(array($data666->location_id));
				$data2=$sth2->fetchObject();
			?>
				<tr>
					<th><?php echo $data666->id;?></th>
					<th><?php echo $data1->occupation;?></th>
					<th><?php echo $data2->location;?></th>
					<th><?php echo $data666->working_time;?></th>
					<th><?php echo $data666->education;?></th>
					<th><?php echo $data666->experience;?></th>
					<th><?php echo $data666->salary;?></th>
					<th>
						<form action="del_fav.php" method="POST">
							<input type="hidden" name="del_id" value="<?php echo $data666->recruit_id?>">
							<input type="submit" value="Delete">
						</form>
					</th>
				</tr><?php
			}?>
	</table>
	<form action="login_jobseeker.php">
		<input type="submit" value="Back To Job Vancancy">
	</form>
<?php }?>