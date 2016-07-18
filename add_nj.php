<?php
	session_save_path("tm");
	session_start();
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);

	if( ! isset( $_SESSION['Account'] ) )
		header( 'Location: homepage.php' );
	else{
		echo "Hello ";
		echo $_SESSION['Account'];
		echo "!!";?>
		
		<form action="logout.php">
			<button type="submit">Logout</button></p>
		</form>
		<table style="width:100%">
			<tr><th>~~~~~Job Vacancy~~~~~</th></tr>
		</table>
			<table style="width:100%">
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
					<th>Operation</th>
				</tr>
				<?php
					if($_POST["sort"]=="Asc"){
						$result4=$db->query("SELECT * FROM `result` ORDER BY `salary` ASC, `id` ASC");
					}
					else if($_POST["sort"]=="Des") {
						$result4=$db->query("SELECT * FROM `result` ORDER BY `salary` DESC, `id` ASC");
					}
					else {
						$result4=$db->query("SELECT * FROM `result`");
					}
					while($data = $result4->fetchObject()){
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
					</tr>
				<?php
				}
			?>
				<tr>
					<th> </th>
					<form action="add_njreg.php"method="POST">
					<th>
						<?php 
						$sql00="SELECT * FROM `occupation`";
						$sth00=$db->prepare($sql00);
						$sth00->execute();?>
						<select name="Occupationid"><?php
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
						<select name="Locationid"><?php
							while($result01=$sth01->fetchObject()){?>
								<option value="<?php echo $result01->id;?>"><?php echo $result01->location;?></option>
							<?php
							}?>
						</select>
					</th>
					<th>
						<select name="WT">
						<option value="Day">Day</option>
						<option value="Night">Night</option>
						</select>
					</th>
					<th>
						<select name="ER">
						<option value="Elementary school">Elementary school</option>
						<option value="Junior high school">Junior high school</option>
						<option value="Senior high school">Senior high school</option>
						<option value="College">College</option>
						<option value="Master degree">Master degree</option>
						<option value="Doctoral degree">Doctoral degree</option>
						</select>
					</th>
					<th>
						<select name="MWE">
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
					<th><input type="number"name="ES"min="15000"max="45000"step="1000"></th>	
					<th>
						<button type="submit">Save</button>
				<?php echo "  ";?>
						<button type="submit">Cancel</button>
				</form>
					</th>
				</tr>	
		</table></p></p>
		<?php } ?>