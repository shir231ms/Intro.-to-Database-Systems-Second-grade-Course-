<body background="design_3d_238065_9.jpg">
	<!--星點圍繞_開始-->
<script language="JavaScript">
<!--
CoLoUrS=new Array('00ff00','ff00ff','fff000','3366ff');
var step=0.3,a_StEp=0.05,RunTime=0,currStep=0,Xpos=0,Ypos=0,cntr=70,count_a=0;
var count=0,move=1,Ay=0,Ax=0,dots=16;var x;brwsr=(document.layers)?1:0;
if (brwsr){
for (i=0; i < dots; i++){
document.write('<LAYER NAME="a'+i+'" LEFT=0 TOP=0 BGCOLOR=#3366ff CLIP="0,0,3,3"></LAYER>');
}
window.captureEvents(Event.MOUSEMOVE);
function nsMouse(evnt){
 Xpos = evnt.pageX;
 Ypos = evnt.pageY;
 }
window.onMouseMove = nsMouse
}
else{
document.write('<div id="ys" style="position:absolute;top:0px;left:0px"><div style="position:relative">');
for (i=0; i < dots; i++){
document.write('<div id="ieDivs" style="position:absolute;top:0px;left:0px;width:3px;height:3px;background:#3366ff;font-size:3px"></div>');
}
document.write('</div></div>');
function ieMouse(){
 Ypos=event.y;
 Xpos=event.x;
 }
window.document.onmousemove = ieMouse
}
function MouseFollow(){
ay = Math.round(Ay+=(Ypos- Ay)* 4/40);
ax = Math.round(Ax+=(Xpos- Ax)* 4/40);
setTimeout('MouseFollow()',10);
}
function colourStep(){
count+=move;
if (count >= dots) {count=0;count_a+=move}
if (count_a == CoLoUrS.length) count_a=0;
if (brwsr) document.layers["a"+count].bgColor=CoLoUrS[count_a];
else ieDivs[count].style.background=CoLoUrS[count_a];
setTimeout('colourStep()',100)
}
function TwistnSpin(){
if (!brwsr) ys.style.top=document.body.scrollTop;
for (i=0; i < dots; i++) 
 {
 var allLayers=(document.layers)?document.layers["a"+i]:ieDivs[i].style;
 allLayers.top=ay+cntr*Math.cos((currStep+i*4)/10.2)*Math.sin(currStep/20);
 allLayers.left=ax+cntr*Math.sin((currStep+i*4)/10.2)*Math.cos(1+currStep/20);
 }
currStep-=step;
setTimeout("TwistnSpin()",10);
}
function CombineNstart(){
MouseFollow();TwistnSpin();colourStep();
}
window.onload=CombineNstart;
-->
</script>
<!--星點圍繞_結束-->

</body>

<?php
	$db_host= "dbhome.cs.nctu.edu.tw";
	$db_name= "scyuan1221_cs";
	$db_user= "scyuan1221_cs";
	$db_password= "09931221";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);
?>
<img align=left src="hello.gif"  width=290 height=80></p></p>
<table style="width:100%">
	<tr><th><font size="9"><FONT COLOR="0000a0"><font face="fantasy"><marquee behavior="alternate" width="50%" align="midden" scrollamount="9">~~~~~Job Vacancy~~~~~</th></tr>
</table>

<!-- define table -->
<table style="width:100%;height:40px;border:5px #FFFF8C dashed;background-color:#D68B00;" bordercolor=FF9D37 rules="all" cellpadding='5'>
	<tr><form method="GET">
		<th bgColor="#FFD78C"> </th>
		<th bgColor="#FFD78C">
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
		<th bgColor="#FFD78C">
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
		<th bgColor="#FFD78C">
			<select name="WT">
			<option value=" "><?php echo "   ";?></option>
			<option value="Day">Day</option>
			<option value="Night">Night</option>
			</select>
		</th>
		<th bgColor="#FFD78C">
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
		<th bgColor="#FFD78C">
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
		<th bgColor="#FFD78C"><select name="ES">
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
		<th><font size="5">ID</th>
		<th><font size="5">Occupation</th>
		<th><font size="5">Location</th>
		<th><font size="5">Work Time</th>
		<th><font size="5">Education Required</th>
		<th><font size="5">Minimum of Working Experience</th>
	<form method="POST">
		<th><font size="5">Salary Per Month
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
					<th bgColor="#FFD78C"><?php echo $data->id;?></th>
					<th bgColor="#FFD78C"><?php echo $data1->occupation;//?></th>
					<th bgColor="#FFD78C"><?php echo $data2->location;//?></th>
					<th bgColor="#FFD78C"><?php echo $data->working_time;?></th>
					<th bgColor="#FFD78C"><?php echo $data->education;?></th>
					<th bgColor="#FFD78C"><?php echo $data->experience;?></th>
					<th bgColor="#FFD78C"><?php echo $data->salary;?></th>
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
					<th bgColor="#FFD78C"><?php echo $data->id;?></th>
					<th bgColor="#FFD78C"><?php echo $data1->occupation;//?></th>
					<th bgColor="#FFD78C"><?php echo $data2->location;//?></th>
					<th bgColor="#FFD78C"><?php echo $data->working_time;?></th>
					<th bgColor="#FFD78C"><?php echo $data->education;?></th>
					<th bgColor="#FFD78C"><?php echo $data->experience;?></th>
					<th bgColor="#FFD78C"><?php echo $data->salary;?></th>
				</tr>
			<?php
			}
		}
		?>
	</table></p></p>

	<table style="width:100%" cellpadding=0 cellspacing=0>
		<tr>
			<th>
				<?php 	echo "<font face=\"fantasy\" size=6 COLOR=#0000a0>[Employer]</font>";?></p>
				<?php 	echo "<font face=\"cursive\" size=5 COLOR=#0000a0>Locking for a staff?</font>";?></p>
				<form action="login_emcheck.php"method="POST">
					<font face=\"fantasy\" size=5 COLOR=#0000a0>Account: <input type="text"name="Account_LIN"></p>
					<font face=\"fantasy\" size=5 COLOR=#0000a0>Password: <input type="password"name="password_LIN"></p>
					<button type="submit" style="width:120px;height:40px;border:2px  inset;background-color:#00FF00;"><b><font face=\"cursive\" size=3 COLOR=#0000a0>Login</button></p>
				</form>
				<form action="signup_employer.php">
					<button type="submit" style="width:120px;height:40px;border:2px  inset;background-color:#00FF00;"><b><font face=\"cursive\" size=3 COLOR=#0000a0>Sign up now</button></p>
				</form>
			</th>
			<th>
				<?php 	echo "<font face=\"fantasy\" size=6 COLOR=#0000a0>[Job Seeker]";?></p>
				<?php 	echo "<font face=\"cursive\" size=5 COLOR=#0000a0>Fill in your restore right now!!";?></p>
				<form action="login_jscheck.php"method="POST">
					Account: <input type="text"name="Account_LIN"></p>
					Password: <input type="password"name="password_LIN"></p>
					<button type="submit" style="width:120px;height:40px;border:2px  inset;background-color:#00FF00;"><b><font face=\"cursive\" size=3 COLOR=#0000a0>Login</button></p>	
				</form>
				<form action="signup_jobseeker.php">
					<button type="submit" style="width:120px;height:40px;border:2px  inset;background-color:#00FF00;"><b><font face=\"cursive\" size=3 COLOR=#0000a0>Sign up now</button></p>
				</form>
			</th>
		</tr>
	</table>



