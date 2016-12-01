<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>

<script src="js/jquery.js"></script>
<script >
	$(function(){
		
	});	

</script>

</body>
</html>
<?php
session_start();

require_once('connect_algodb.php');
//require_once('countdown.php');
require_once('core.php');
$_SESSION['winner']=0;

if((isset($_SESSION['player2']))){
/*for storing moves*/

$_SESSION['p1r']=array();
$_SESSION['p1c']=array();
$_SESSION['p1r2']=array();
$_SESSION['p1c2']=array();
$_SESSION['p2r']=array();
$_SESSION['p2c']=array();
$_SESSION['p2r2']=array();
$_SESSION['p2c2']=array();

/*data initialization*/

//user data
$num=$_SESSION['num'];
$userid1=$_SESSION['player1'];
$userid2=$_SESSION['player2'];
$error_msg="";
$p1_name=$fplayer1=$_SESSION['fplayer1'];
$p2_name=$fplayer2=$_SESSION['fplayer2'];


// code files
$my_file1="codes/$userid1".".c";
$my_file2="codes/$userid2".".c";
$moniter_file="codes/moniter".".cpp";

//actual files
$moniter="$num/moniter.cpp";
$p1_code="$num/p1.cpp";
$p2_code="$num/p2.cpp";
$input1="$num/input1.txt";
$input2="$num/input2.txt";
$moniter_input="$num/moniter_input.txt";

make_file('',$input1);
make_file('',$input2);
make_file('',$moniter_input);
$file_contents = file_get_contents($my_file1);
make_file($file_contents ,$p1_code);
$file_contents = file_get_contents($my_file2);
make_file($file_contents ,$p2_code);
$file_contents = file_get_contents($moniter_file);
make_file($file_contents ,$moniter);
	
$p1m=0;
$p2m=0;
$move=0;

//input -256 to  moniter
//save output to input1

file_put_contents($moniter_input,"-256");
$error=shell_exec("g++ -o om $moniter   2>&1");
	if(empty($error)){
		$output=shell_exec("./om < $moniter_input");
		file_put_contents($input1,$output);
		
		

		$p1_e=0;$p2_e=0;
		
		$error1=shell_exec("g++ -o op1 $p1_code   2>&1");
		if(!empty($error1)){
			$p1_e=1;
		}
		$error2=shell_exec("g++ -o op2 $p2_code   2>&1");
		if(!empty($error2)){
			$p2_e=1;
		}
		
		if($p1_e==1&&$p2_e==0){
			$error_msg = 'error in p1';
			$winner = $p2_name;
			
		}else if($p1_e==0&&$p2_e==1){
			$error_msg = 'error in p2';
			$winner = $p1_name;
			
		}else if($p1_e==1&&$p2_e==1){
			$error_msg = 'error in both';
			
		}else{
			
			//give input1 to p1_code
//append output and input1-> moniter_input
//get output and give it to input2 if number end here
			while(true){
				$output1=shell_exec("./op1 < $input1");
				if(!empty($output1)){
					sscanf($output1, "%d %d %d %d",$x,$y,$x2,$y2);
					echo '<hr><span class="print">'.$p1_name.' played at('.$x.','.$y.') and crossed at ('.$x2.','.$y2.')</span>';
					$_SESSION['p1r'][$p1m]=$x;
					$_SESSION['p1c'][$p1m]=$y;
					$_SESSION['p1r2'][$p1m]=$x2;
					$_SESSION['p1c2'][$p1m]=$y2;
					$p1m++;
					$move++;
				
					$file_contents = file_get_contents($input1);
					file_put_contents($moniter_input,$file_contents.' '.$output1);
					
					$outputm=shell_exec("./om < $moniter_input");
					if(!empty($outputm)){
						
						sscanf($outputm,"%d",$type);
						if($type==-11111){
						//wrong move
							$error_msg="p1 made wrong move";
							$winner = $p2_name;
							break;
						}else if($type==-22222){
						//winner
							//$error_msg="p1 made wrong move";
							$winner = $p1_name;
							break;
						}else if($type==-33333){
						//lost
							//$error_msg="p1 made wrong move";
							$winner = $p2_name;
							break;
						}else if($type==-44444){
						//draw
							$error_msg="match draw";
							//$winner = $p2_name;
							break;
						}else{
							file_put_contents($input2,$outputm);
						}
					}
					
			
				}else{
				//no output
					$error_msg="p1 didn't made move";
					$winner = $p2_name;
					break;
				}
				$output2=shell_exec("./op2 < $input2");
				if(!empty($output2)){
					sscanf($output2, "%d %d %d %d",$x,$y,$x2,$y2);
					echo '<hr><span class="print">'.$fplayer2.' played at('.$x.','.$y.') and crossed at ('.$x2.','.$y2.')</span>';
					$_SESSION['p2r'][$p2m]=$x;
					$_SESSION['p2c'][$p2m]=$y;
					$_SESSION['p2r2'][$p2m]=$x2;
					$_SESSION['p2c2'][$p2m]=$y2;
					$p2m++;
					$move++;
				
					$file_contents = file_get_contents($input2);
					file_put_contents($moniter_input,$file_contents.' '.$output2);
					
					$outputm=shell_exec("./om < $moniter_input");
					if(!empty($outputm)){
						
						sscanf($outputm,"%d",$type);
						if($type==-11111){
						//wrong move
							$error_msg="p2 made wrong move";
							$winner = $p1_name;
							break;
						}else if($type==-22222){
						//winner
							//$error_msg="p1 made wrong move";
							$winner = $p2_name;
							break;
						}else if($type==-33333){
						//lost
							//$error_msg="p1 made wrong move";
							$winner = $p1_name;
							break;
						}else if($type==-44444){
						//draw
							$error_msg="match draw";
							//$winner = $p2_name;
							break;
						}else{
							file_put_contents($input1,$outputm);
						}
					}
					
			
				}else{
				//no output
					$error_msg="p2 didn't made move";
					$winner = $p1_name;
					break;
				}
			}
			
			
		}
	
		
		
		
		
	}else{
	
		//echo $error;
		$error_msg="$error Internal error in moniter";
		
	}
	echo $error_msg.' '.$winner;


$_SESSION['i']=-1;
$_SESSION['max']=$move-1;
$_SESSION['pp1']=-1;
$_SESSION['pp2']=-1;

$_SESSION['winner']=$winner;


echo '<span class="win-disp"><br>player '.$_SESSION['winner'].' Won the Game<a href="trial-exec.php" style="color:rgb(242, 9, 25);"><b> Wanna Play with other</b></span>';

//for animation
redirect_to('end.php');							



}
?>