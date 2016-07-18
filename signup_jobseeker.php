<?php
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
?>
<?php 	echo "Fill in your resume";?></p></p>
<form action="signup_jscheck.php"method="POST">
	<table style="width:100%">
		<tr>
			<th>Account</th>
			<th>Password</th>
			<th>Phone</th>
			<th>Gender</th>
		</tr>
		<tr>	
			<th><input type="text"name="Account"></th>
			<th><input type="password"name="Password"></th>
			<th><input type="text"name="Phone"></th>
			<th>
				<select name="Gender">
				  <option value=" ">  </option>
				  <option value="Male">Male</option>
				  <option value="Female">Female</option>
				</select>
			</th>
		</tr></p></p>
		<tr>
			<th>Age</th>
			<th>Email address</th>
			<th>Expected Salary</th>
			<th>Major Education</th>
		</tr>
		<tr>
			<th><input type="number"name="Age"min="15"max="60"></th>
			<th><input type="text"name="EA"></th>
			<th><input type="number"name="ES"min="15000"max="45000"step="1000"></th>
			<th><input type="text"name="ME"></th>
		</tr>
	</table></p>
	<?php	
		echo "What is your specialty?<br><br>";
		$sql=$db->query("SELECT * FROM `specialty`");
		while($result=$sql->fetchObject()){?>
			<input type="checkbox" name="choice[]" value="<?php echo $result->id ;?>">
			<?php echo $result->specialty;
		}
	?></p>
	<button type="submit">Submit</button>
</form>
<form action="homepage.php">
	<button type="submit">Back</button></p>		 
</form>
