<?php

session_start();

require_once('connect_algodb.php');
require_once('countdown.php');
require_once('core.php');

if(!isset($_SESSION['email'])){
	redirect_to('login.php');
}
if(isset ($_SESSION['error'])&&$_SESSION['error']==1){
	echo '<span class="php-msg"><div class="cr-php"></div>Error Occured</span>';
}
if(isset ($_SESSION['msg'])&&!empty($_SESSION['msg'])){
	echo '<span class="php-msg"><div class="cr-php"></div>'.$_SESSION['msg'].'</span>';
	$_SESSION['msg']='';
	
}
if(isset($_POST['code'])){
	
	//echo 'ho';
	$userid=$_SESSION['email'];
	$roll=$_SESSION['roll'];
	$name=$_SESSION['name'];
	$fname='codes/'.$userid.'.c';
	$fp=fopen($fname,'w');
	file_put_contents($fname,$_POST['code']);

	$output = shell_exec("gcc $fname 2>&1");
	if(!empty($output)){
		echo '<span class="php-msg"><div class="cr-php"></div>'.$output.'</span>';
		$_SESSION['error']=1;
		
	}else{
		$_SESSION['error']=0;
		//SELECT * FROM `players` WHERE `email`='$userid'
		$quiry="SELECT * FROM `players` WHERE `email`='$userid'";
		if($Squiry=mysqli_query($mysqli,$quiry)){
			if(mysqli_num_rows($Squiry) == 0){
				$quiry="INSERT INTO `players`(`id`, `email`,`name`,`roll`,`time`) VALUES ('','$userid','$name','$roll','')";
					if($Squiry=mysqli_query($mysqli,$quiry)){
						echo 'done';
					}else echo 'failed';
			}
			echo '<span class="php-msg"><div class="cr-php"></div>Code Submitted successfully<a href="trial-exec.php">Choose your opponent!!</a></span>';
			redirect_to('trial-exec.php');
		}else{
			echo 'not done';
		}
		//add userid in table if not in table
	}

}

?>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>

 <a href="table.php"><span style="color:white; position:fixed; right:7%;top:25%; font-size:1.5em; font-family:cursive" title="Gameboard">Click To See Gameboard</span></a>
<div class="page-b" id="f-page">
<div style="position : fixed; bottom:2%;color :white; margin:0;padding:0;">

Download<a href="cagerules.txt" style="color :white; " download> Game problem Statement</a><br><br>
Get the<a href="codes/player.c" style="color :white;" download> Sample code Here!!</a>
</div>
<a href="logout.inc.php" title="Logout"><img style="position:fixed; top:20; right:20" src="img/logout.png"></a>
<div style="position:fixed; top:30; right:120; font-family: cursive; font-size: 2em; color: white;">Welcome, <?php echo $_SESSION['name'];?></div>

<div class="center">
<span class="mid">Let`s Enter in <b>Clash Of Codes!!</b></span>
<div class="enter mid">Start</div>
</div>
</div>
<div id="codeSub" class="page-a" id="c">

<a href="logout.inc.php" title="Logout"><img style="position:fixed; top:85; right:20" src="img/logout.png"></a>
<div style="position:fixed; top:110; right:120; font-family: cursive; font-size: 2em; color: white;">Welcome, <?php echo $_SESSION['name'];?></div>
<span class="biggest small_shadow" style="color:white;">Please Submit your C code here... </span><br><br>
<form method="post" action="index.php" >
<textarea class="code" name="code" placeholder="Your C code"></textarea>	
<input type="submit"  class="sub_button" value="Submit Code" />
</form>
<?php
	$userid=$_SESSION['email'];
	if(file_exists ("codes/$userid.c")){
		$_SESSION['error']=0;
	?>
<span style="color:white">
OR
<a href="trial-exec.php" style="color:red" >Play with your previous code...</a>
</span>
<?php
	}else{
		echo 'You Haven`t submitted any code before.';
	}
	?>
</div>
<script src="js/jquery.js"></script>
<script >
	
$(function(){
		$('.enter').click(function(){
			$('#f-page').fadeOut(1000);
			$('#codeSub').fadeIn(1500);
		});
		$('.cr-php').click(function(){
		$('.php-msg').hide(500);
	});
	});	
</script>

</body>
</html>