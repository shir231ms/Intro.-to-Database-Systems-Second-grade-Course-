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
		<tr><th>~~~~~Job Vacancy~~~~~</th></tr>
	</table>
	<table style="width:100%">
		<tr><form method="GET">
			<th> </th>
			<th>
				<?php 
				$sql00="SELECT * FROM `occupation`";
				$sth00=$db->prepare($sql00);
				$sth00->execute();?>
				<select name="Occupationid">
					<option value=0><?php echo "   ";?></option><?php
					while($result00=$sth00->fetchObject()){?>
						<option value="<?php echo $result00->id;?>"><?php echo $result00->occupation;?></option>	
					<?php
					}?>
				</select>
			</th>
			<th>
				<?php 
				$sql01="SELECT * FROM `location`";
				$sth01=$db->prepare($sql01);
				$sth01->execute();?>
				<select name="Locationid">
					<option value=0><?php echo "   ";?></option>
					<?php
					while($result01=$sth01->fetchObject()){?>
						<option value="<?php echo $result01->id;?>"><?php echo $result01->location;?></option>
					<?php
					}?>
				</select>
			</th>
			<th>
				<select name="WT">
				<option value=" "><?php echo "   ";?></option>
				<option value="Day">Day</option>
				<option value="Night">Night</option>
				</select>
			</th>
			<th>
				<select name="MWE">
				<option value=" "><?php echo "   ";?></option>
				<option value="Elementary school">Elementary school</option>
				<option value="Junior high school">Junior high school</option>
				<option value="Senior high school">Senior high school</option>
				<option value="College">College</option>
				<option value="Master degree">Master degree</option>
				<option value="Doctoral degree">Doctoral degree</option>
				</select>
			</th>
			<th>
				<select name="ER">
				<option value=" "><?php echo "   ";?></option>
				<option value="No experience required">No experience required</option>
				<option value="1(year)">1(year)</option>
				<option value="2(years)">2(years)</option>
				<option value="3(years)">3(years)</option>
				<option value="4(years)">4(years)</option>
				<option value="5(years)">5(years)</option>
				<option value="6(years)">6(years)</option>
				<option value="7(years)">7(years)</option>
				<option value="8(years)">8(years)</option>
				<option value="9(years)">9(years)</option>
				<option value="10(years)">10(years)</option>
				</select>
			</th>
			<th><select name="ES">
				<option value=0><?php echo "   ";?></option>
				<option value="A"> <20000 </option>
				<option value="B"> more than 20000 and <30000 </option>
				<option value="C"> more than 30000 and <40000 </option>
				<option value="D"> >40000 </option>
				</select>
				<?php echo " ";?>
				<input type="submit" name="search" value="Search">
				<form action="homepage.php" >
					<input type="submit" value="View total">
				</form>
			</th>
			</form>
		</tr>
		<tr>
			<th>ID</th>
			<th>Occupation</th>
			<th>Location</th>
			<th>Work Time</th>
			<th>Education Required</th>
			<th>Minimum of Working Experience</th>
		<form method="POST">
			<th>Salary Per Month
				<input type="submit" name="sort" value="Asc">
				<?php echo " ";?>
				<input type="submit" name="sort" value="Des">
			</th>
		</form>
		</tr>
		<?php
		//Search method//
			$num=0;
			$sql222="SELECT * FROM `result`";
			if($_GET["search"]=="Search"){
				//occupation column
				if($_GET["Occupationid"]!=0){ $sql222=$sql222." WHERE `occupation_id`='".$_GET["Occupationid"]."'"; $num++; }
				//location column
				if($num==0 && $_GET["Locationid"]!=0){ $sql222=$sql222." WHERE `location_id`='".$_GET["Locationid"]."'"; $num++; }
				else if($num!=0 && $_GET["Locationid"]!=0){ $sql222=$sql222." AND `location_id`='".$_GET["Locationid"]."'"; }
				//working_time column
				if($num==0 && $_GET["WT"]!=" "){ $sql222=$sql222." WHERE `working_time`='".$_GET["WT"]."'"; $num++; }
				else if($num!=0 && $_GET["WT"]!=" "){ $sql222=$sql222." AND `working_time`='".$_GET["WT"]."'"; }
				//education column
				if($num==0 && $_GET["MWE"]!=" "){ $sql222=$sql222." WHERE `education`='".$_GET["MWE"]."'"; $num++; }
				else if($num!=0 && $_GET["MWE"]!=" "){ $sql222=$sql222." AND `education`='".$_GET["MWE"]."'"; }
				//experience column
				if($num==0 && $_GET["ER"]!=" "){ $sql222=$sql222." WHERE `experience`='".$_GET["ER"]."'"; $num++; }
				else if($num!=0 && $_GET["ER"]!=" "){ $sql222=$sql222." AND `experience`='".$_GET["ER"]."'"; }
				//salary column
				if($_POST["sort"]=="Asc"){
					if($_GET["ES"]=="A"){
						if($num==0){ $sql222=$sql222." WHERE `salary`<20000 ORDER BY `salary` ASC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`<20000 ORDER BY `salary` ASC, `id` ASC"; }	
					}
					else if($_GET["ES"]=="B"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=20000 AND `salary`<30000 ORDER BY `salary` ASC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=20000 AND `salary`<30000 ORDER BY `salary` ASC, `id` ASC"; }
					}
					else if($_GET["ES"]=="C"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=30000 AND `salary`<40000 ORDER BY `salary` ASC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=30000 AND `salary`<40000 ORDER BY `salary` ASC, `id` ASC"; }
					}
					else if($_GET["ES"]=="D"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=40000 ORDER BY `salary` ASC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=40000 ORDER BY `salary` ASC, `id` ASC"; }
					}
					else if($_GET["ES"]==0){
						$sql222=$sql222." ORDER BY `salary` ASC, `id` ASC"; 
					}
				}
				else if($_POST["sort"]=="Des") {
					if($_GET["ES"]=="A"){
						if($num==0){ $sql222=$sql222." WHERE `salary`<20000 ORDER BY `salary` DESC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`<20000 ORDER BY `salary` DESC, `id` ASC"; }	
					}
					else if($_GET["ES"]=="B"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=20000 AND `salary`<30000 ORDER BY `salary` DESC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=20000 AND `salary`<30000 ORDER BY `salary` DESC, `id` ASC"; }
					}
					else if($_GET["ES"]=="C"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=30000 AND `salary`<40000 ORDER BY `salary` DESC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=30000 AND `salary`<40000 ORDER BY `salary` DESC, `id` ASC"; }
					}
					else if($_GET["ES"]=="D"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=40000 ORDER BY `salary` DESC, `id` ASC"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=40000 ORDER BY `salary` DESC, `id` ASC"; }
					}
					else if($_GET["ES"]==0){
						$sql222=$sql222." ORDER BY `salary` DESC, `id` ASC"; 
					}
				}
				else {
					if($_GET["ES"]=="A"){
						if($num==0){ $sql222=$sql222." WHERE `salary`<20000"; $num++; }
						else{ $sql222=$sql222." AND `salary`<20000"; }	
					}
					else if($_GET["ES"]=="B"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=20000 AND `salary`<30000"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=20000 AND `salary`<30000"; }
					}
					else if($_GET["ES"]=="C"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=30000 AND `salary`<40000"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=30000 AND `salary`<40000"; }
					}
					else if($_GET["ES"]=="D"){
						if($num==0){ $sql222=$sql222." WHERE `salary`>=40000"; $num++; }
						else{ $sql222=$sql222." AND `salary`>=40000"; }
					}
				}
				//echo $sql222;
				$sth222=$db->prepare($sql222);
				$sth222->execute();
				while($data = $sth222->fetchObject()){
					$sql1="SELECT * FROM `occupation`"
										."WHERE `id`=?";//
					$sth1=$db->prepare($sql1);//
					$sth1->execute(array($data->occupation_id));//
					$data1=$sth1->fetchObject();//
					$sql2="SELECT * FROM `location`"
							."WHERE `id`=?";
					$sth2=$db->prepare($sql2);
					$sth2->execute(array($data->location_id));
					$data2=$sth2->fetchObject();?>
					
					<tr>
						<th><?php echo $data->id;?></th>
						<th><?php echo $data1->occupation;//?></th>
						<th><?php echo $data2->location;//?></th>
						<th><?php echo $data->working_time;?></th>
						<th><?php echo $data->education;?></th>
						<th><?php echo $data->experience;?></th>
						<th><?php echo $data->salary;?></th>
						<?php
							$sql555="SELECT * FROM `user` WHERE `account`=?";
							$sth555=$db->prepare($sql555);
							$sth555->execute(array($_SESSION["Account"]));
							$res=$sth555->fetchObject();
						?>
						<th><?php
							$sql77="SELECT * FROM `application` WHERE `recruit_id`=?";
							$sth77=$db->prepare($sql77);
							$sth77->execute(array($data->id));
							if($da77=$sth77->fetchObject()){
								echo "Waiting for employer";
							}
							else {?>
								<form action="apply.php"method="POST">
									<input type="hidden" name="apply" value="<?php echo $data->id;?>">
									<input type="hidden" name="userid" value="<?php echo $res->id;?>">
									<button type="submit"name="submit" value="yes">Apply</button>
								</form><?php
							}?>
						</th>
						<th><?php
							$sql33="SELECT * FROM `favorite` WHERE `recruit_id`=?";
							$sth33=$db->prepare($sql33);
							$sth33->execute(array($data->id));
							if($da33=$sth33->fetchObject()){
								echo "Already in favorite list";
							}
							else{?>
								<form action="fav_insert.php"method="POST">
									<input type="hidden" name="like" value="<?php echo $data->id;?>">
									<input type="hidden" name="userid" value="<?php echo $res->id;?>">
									<button type="submit">Favorite</button>
								</form><?php
							}?>
						</th>
					</tr>
				<?php
				}
			}
			else {
				if($_POST["sort"]=="Asc"){
					$result=$db->query("SELECT * FROM `result` ORDER BY `salary` ASC, `id` ASC");
				}
				else if($_POST["sort"]=="Des") {
					$result=$db->query("SELECT * FROM `result` ORDER BY `salary` DESC, `id` ASC");
				}
				else {
					$result=$db->query("SELECT * FROM `result`");
				}
				while($data = $result->fetchObject()){
					$sql1="SELECT * FROM `occupation`"
										."WHERE `id`=?";//
					$sth1=$db->prepare($sql1);//
					$sth1->execute(array($data->occupation_id));//
					$data1=$sth1->fetchObject();//
					$sql2="SELECT * FROM `location`"
							."WHERE `id`=?";
					$sth2=$db->prepare($sql2);
					$sth2->execute(array($data->location_id));
					$data2=$sth2->fetchObject();?>
					
					<tr>
						<th><?php echo $data->id;?></th>
						<th><?php echo $data1->occupation;//?></th>
						<th><?php echo $data2->location;//?></th>
						<th><?php echo $data->working_time;?></th>
						<th><?php echo $data->education;?></th>
						<th><?php echo $data->experience;?></th>
						<th><?php echo $data->salary;?></th>
						<?php
							$sql555="SELECT * FROM `user` WHERE `account`=?";
							$sth555=$db->prepare($sql555);
							$sth555->execute(array($_SESSION["Account"]));
							$res=$sth555->fetchObject();
						?>
						<th><?php
							$sql77="SELECT * FROM `application` WHERE `recruit_id`=?";
							$sth77=$db->prepare($sql77);
							$sth77->execute(array($data->id));
							if($da77=$sth77->fetchObject()){
								echo "Waiting for employer";
							}
							else {?>
								<form action="apply.php"method="POST">
									<input type="hidden" name="apply" value="<?php echo $data->id;?>">
									<input type="hidden" name="userid" value="<?php echo $res->id;?>">
									<button type="submit"name="submit" value="yes">Apply</button>
								</form><?php
							}?>
						</th>
						<th><?php
							$sql33="SELECT * FROM `favorite` WHERE `recruit_id`=?";
							$sth33=$db->prepare($sql33);
							$sth33->execute(array($data->id));
							if($da33=$sth33->fetchObject()){
								echo "Already in favorite list";
							}
							else{?>
								<form action="fav_insert.php"method="POST">
									<input type="hidden" name="like" value="<?php echo $data->id;?>">
									<input type="hidden" name="userid" value="<?php echo $res->id;?>">
									<button type="submit"name="fav" value="no">Favorite</button>
								</form><?php
							}?>
						</th>
					</tr>
				<?php
				}
			}
		?>
	</table></p></p>
	<form action="favorite.php">
		<input type="submit" value="Favorite List">
	</form>
<?php } ?>