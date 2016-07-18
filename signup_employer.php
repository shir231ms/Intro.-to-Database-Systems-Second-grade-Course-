<?php
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
?>
<?php 	echo "Registration";?></p>
<?php 	echo "New Employer to Job-Hunt System?";?></p></p>
<form action="signup_emcheck.php" method="POST">
	<table style="width:50%">
		<tr>
			<th>Account</th>
			<th>Password</th>
		</tr>
		<tr>
			<th><input type="text"name="Account"/></th>
			<th><input type="password"name="Password"/></th>
		</tr></p></p>
		<tr>
			<th>Phone number</th>
			<th>Email</th>
		</tr>
		<tr>
			<th><input type="text"name="Phone number"/></th>
			<th><input type="text"name="Email"/></th>
		</tr>
	</table><br><br>
	<button type="submit">Submit</button>
</form>
<form action="homepage.php">
	<button type="submit">Back</button></p>		 
</form>
