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
	
	if( !isset( $_SESSION['Account'])  )
		header( 'Location: homepage.php' );
	else{
		echo "Hello ";
		echo $_SESSION['Account'];
		echo "!!";?>
		<form action="logout.php">
			<button type="submit">Logout</button></p>
		</form>
		<!-- define table -->
		<table style="width:100%">
			<tr><th>~~~~~Who Applies For Your Job~~~~~</th></tr>
		</table>
		<table style="width:100%"><?php
			$sql01="SELECT * FROM `employer` WHERE `account`=?";
			$sth01=$db->prepare($sql01);
			$sth01->execute(array($_SESSION['Account']));
			$result01=$sth01->fetchObject();
			
			$sql10="SELECT * FROM `result` WHERE `employer_id`=?";
			$sth10=$db->prepare($sql10);
			$sth10->execute(array($result01->id));
			
			while($result10=$sth10->fetchObject()){
				$sql1="SELECT * FROM `occupation`"
						."WHERE `id`=?";//
				$sth1=$db->prepare($sql1);//
				$sth1->execute(array($result10->occupation_id));//
				$data1=$sth1->fetchObject();//
				$sql2="SELECT * FROM `location`"
						."WHERE `id`=?";
				$sth2=$db->prepare($sql2);
				$sth2->execute(array($result10->location_id));
				$data2=$sth2->fetchObject();?>
				<tr>
					<th><?php echo $data1->occupation;//?></th>
					<th><?php echo $data2->location;//?></th>
					<th><?php echo $result10->working_time;?></th>
					<th><?php echo $result10->education;?></th>
					<th><?php echo $result10->experience;?></th>
					<th><?php echo $result10->salary;?></th>
				</tr><?php
				//JOIN: use `application` table
				$sql111="SELECT application.user_id, application.recruit_id, user.account, user.gender, user.age, user.education, 
						 user.expected_salary, user.phone, user.email FROM `user` INNER JOIN `application` 
						 WHERE user.id=application.user_id AND application.recruit_id=?";
				$sth111=$db->prepare($sql111);
				$sth111->execute(array($result10->id));		
				while($result111=$sth111->fetchObject()){?>
					<tr>
						<th><?php echo $result111->account;//?></th>
						<th><?php echo $result111->gender;//?></th>
						<th><?php echo $result111->age;?></th>
						<th><?php echo $result111->education;?></th>
						<th><?php echo $result111->expected_salary;?></th>
						<th><?php echo $result111->phone;?></th>
						<th><?php echo $result111->email;?></th>
						<th><?php 
								$sql="SELECT * FROM `user_specialty`"
										."WHERE `user_id`=?";
								$sth=$db->prepare($sql);
								$sth->execute(array($result111->id));
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
						<th>
							<form action="hire.php" method="POST">
								<input type="hidden" name="hire_resultid" value="<?php echo $result10->id;?>">
								<input type="submit" value="Hire">	
							</form>
						</th>
					</tr><?php
				}
			}
			?>
		</table></p>
		<form action="login_employer.php">
			<input type="submit" value="Back to Job Vancancy">
		</form>

	<?php }?>	