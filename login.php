<?php
session_start();
require_once('core.php');
require_once('connect_algodb.php');
require_once('countdown.php');
if(isset($_POST['rname']) &&
       isset($_POST['remail'])   &&
       isset($_POST['rpass'])      &&
       isset($_POST['rroll'])){
            
            
		$email = $_POST['remail'] ;
		$name = $_POST['rname'] ;
		$pass=$_POST['rpass']     ;
		$roll=$_POST['rroll'];
		$pass = md5($pass);
	
		if(
		   !empty($email) && 
		   !empty($name) && 
		   !empty($roll) && 
		   !empty($pass)){
				$pswd = md5($pass);
				$query = "SELECT `id` FROM `registered` WHERE `email` = '".mysqli_real_escape_string($mysqli,$email)."' ";
				if(@$query_run = mysqli_query($mysqli,$query)){
					if(mysqli_num_rows($query_run)==1){
						echo '<span class="php-msg"><div class="cr-php"></div>Email you have entered is already registered..!!, Please Try again with different email.</span>';
					}else if(mysqli_num_rows($query_run) == 0){
						$query = "INSERT INTO `registered` VALUES('',
																'".mysqli_real_escape_string($mysqli,$name)."',
																'".mysqli_real_escape_string($mysqli,$roll)."',
																'".mysqli_real_escape_string($mysqli,$email)."',
																'".mysqli_real_escape_string($mysqli,$pass)."',
																'".mysqli_real_escape_string($mysqli,'keyhere')."')";
						if($query_run = mysqli_query($mysqli,$query)){
							 //Uploading profile pic
							
							$activation = md5(uniqid(rand(), true));
							$query_insert_user ="UPDATE `registered` SET `activation`= '$activation' WHERE `email`= '$email'";
							$result_insert_user = mysqli_query($mysqli, $query_insert_user);
							if (!$result_insert_user){
								echo '<span class="php-msg"><div class="cr-php"></div>An error occured, Please try again</span>';
							}
							//send email
							if (mysqli_affected_rows($mysqli) == 1) { 
							//If the Insert Query was successfull.
							$message = " To activate your account, please click on this link:\n\n";
							$message .= 'http://www.oopadai.com/algo/activate.php?email=' . urlencode($email).'&category=teacher&name='.urlencode($name).'&key='.urldecode($activation);
							mail($email, 'Registration Confirmation', $message, 'From:noreply@codingClubNITD.com');
							echo '<span class="php-msg"><div class="cr-php"></div>Success, Thanks For Registraion !!<br/><br/>Please click on the link sent to your email</span>';
							
							}else{
								echo 'Please try again';
							} 
							
						}else{
							echo '<span class="php-msg"><div class="cr-php"></div>Sorry your registration process failed</span>';
						}
					}
				}else echo '<span class="php-msg"><div class="cr-php"></div>First query not run</span>';
			
		}else{
			echo '<span class="php-msg"><div class="cr-php"></div>All fields are required..!!</span>';
		}
	}
	
	  if(isset($_POST['lemail']) && isset($_POST['lpass'])){
		  //echo 'hi';
        $loginemail = $_POST['lemail'];
        $lpswd = $_POST['lpass'];
		$password_hash = md5($lpswd);
        
        if(!empty($loginemail) && !empty($lpswd)){
            
                $query = "SELECT * FROM `registered` WHERE `email` = '".mysqli_real_escape_string($mysqli,$loginemail)."' AND `pass` = '".mysqli_real_escape_string($mysqli,$password_hash)."' LIMIT 1 ";
                if($query_run = mysqli_query($mysqli,$query)){	
					if(mysqli_num_rows($query_run)==1){
                    
						$row = mysqli_fetch_assoc($query_run);
						$activation_key = $row['activation'];						
						$loginname = $row['name'];
						$loginroll = $row['roll'];
						
						if($activation_key == NULL){
							$_SESSION['email'] = $loginemail;
							$_SESSION['name'] = $loginname;
							$_SESSION['roll'] = $loginroll;
							redirect_to('index.php');
						}else{
							echo '<span class="php-msg"><div class="cr-php"></div>Your email is not verified, Please verify your email</span>';
						}
					}else{
                        echo '<span class="php-msg"><div class="cr-php"></div>Email / Password combination is wrong or you haven\'t registered yet</span>';
					}
				}
            
		}else{
			echo '<span class="php-msg"><div class="cr-php"></div>All fields are required</span>';
		}
	  }
?><html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
<div class="page-b" id="login-page" style="display:flex;">
<div class="straight">
<span class="biggest small_shadow " style="color:white">Please Login/Register to Fight </span>
<div id="login-reg">
<div id="login">
<form  action="login.php" method="post">
<br>
<span class="straight" ><span class="mid small_shadow "style="margin-left:30%;" >Login</span></span><br><br>
<br><br><br>
<input type="email" name="lemail" placeholder="&nbsp;Email"/><br><br>
<input type="password" name="lpass" placeholder="&nbsp;Password"/><br><br>
<input type="submit" value="Login" />
</form>
</div>
<div id="register">
<br>
<span class="straight" ><span class="mid small_shadow "style="margin-left:30%;" >Register</span></span><br><br><br>
<form action="login.php" method="post">
<input type="text" name="rname" placeholder="&nbsp;Name"/><br><br>
<input type="text" class="rrll" name="rroll" placeholder="&nbsp;College"/><br>
<div class="roll_hover" style="display:none;">Please enter valid roll no!!!</div><br>
<input type="email" class="remail" name="remail" placeholder="&nbsp;Email"/><br>
<div class="remail_hover" style="display:none;" >Confirmation mail will be sent to your email so enter valid email.</div><br>
<input type="password" name="rpass" placeholder="&nbsp;Password"/><br><br>
<input type="submit" value="Register" />
</form>
</div>
</div>
</div>
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
	
	$(document).ready(function(){
	$(".rroll").hover(function(){
		$(".remail_hover").hide();
		$(".roll_hover").show();
	});
	$(".rroll").click(function(){
		$(".remail_hover").hide();
		$(".roll_hover").show();
	});
	$(".remail").hover(function(){
		$(".roll_hover").hide();
		$(".remail_hover").show();
	});
	$(".remail").click(function(){
		$(".roll_hover").hide();
		$(".remail_hover").show();
	});
	$(".rroll").mouseleave(function(){
		$(".roll_hover").hide();
	});
	$(".remail").mouseleave(function(){
		$(".remail_hover").hide();
	});
	});

</script>

</body>
</html>