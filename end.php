<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<style>
	body{
	margin:0;
	padding:0;
	}
			.table2 th, .table2 td{
				border:1px solid white;
				padding:10px;
				margin:0;
				color:white;
			}
			.table2{
				background-color:black;
				opacity:0.8;
				padding:2%;
			}
	</style>
</head>
<body>
<?php
/* just for animation purpose*/

session_start();
require_once('connect_algodb.php');
//require_once('countdown.php');
require_once('core.php');

$_SESSION['i']++;

$_SESSION['end']=0;
if($_SESSION['i']>$_SESSION['max']){
	$_SESSION['end']=1;
}

$rows=5;$cols=5;


$start=0;$end=4;

function disp(){
	echo "\n";
	global $rows,$cols;
	?>
	
	<div class="" style="position:absolute;" >
	<div style="background-image:url('img/w-2.jpg');">
	<table style="border:1px solid black;"  cellspacing=0>
	<?php
	for ($i=0;$i<$rows;$i++){
	?>	<tr>
	<?php
		for ($j=0;$j<$cols;$j++){
	?><td style="border:1px solid black; width:50px; height:50px ; "class="<?php if($_SESSION['a'][$i][$j]==-1) echo 'cross';?>" >
	<?php
	if($_SESSION['a'][$i][$j]==1){
		?>
		<svg width="50" height="50" >
<circle cx="25" cy="25" r="15" fill="rgb(242, 9, 25)"/>
</svg>
		<?php
	}else if($_SESSION['a'][$i][$j]==2){
		?>
		<svg width="50" height="50" >
<circle cx="25" cy="25" r="15" fill="black"/>
</svg>
		
	<?php
	}else if($_SESSION['a'][$i][$j]==-1){
	
	}?>
	</td>
	<?php
		}
	?></tr>
	<?php
	}
	?>
	</table>
	</div>
	</div>
	<?php
}

function dispTable(){
	echo "\n";
	$_SESSION['a']=array(
		array(0,0,1,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,2,0,0)
		);
	?>
	
	<div class="" style="position:absolute; top:50%" >
	
	<table class="table2" style="border:1px solid black;"  cellspacing=0>
		<tr>
		<th>Sr No.</th>
		<th>Player</th>
		<th>Move</th>
		<th>Cross</th>
		
		</tr>
		
		<?php
		$pp1=-1;
		$pp2=-1;
			for($i=0;$i<=$_SESSION['max'];$i++){
				?>
				<tr>
				<?php
				if($i%2==0){
					$pp1++;
					$player=1;
					$x=$_SESSION['p1r'][$pp1];
					$y=$_SESSION['p1c'][$pp1];
					$x2=$_SESSION['p1r2'][$pp1];
					$y2=$_SESSION['p1c2'][$pp1];
					
				}else{
					$pp2++;
					$player=2;
					$x=$_SESSION['p2r'][$pp2];
					$y=$_SESSION['p2c'][$pp2];
					$x2=$_SESSION['p2r2'][$pp2];
					$y2=$_SESSION['p2c2'][$pp2];
				}
				?>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $player; ?></td>
				<td><?php echo '('.$x.','.$y.')'; ?></td>
				<td><?php echo '('.$x2.','.$y2.')'; ?></td>
				
				</tr>
				<?php
			}
		?>
		</tr>
		<tr>
		<td colspan=5><?php
		echo 'winner is'.$_SESSION['winner'];
		?></td>
		</tr>
	</table>
	</div>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	
	<?php
}

function editM($player,$x,$y){
	global $start,$end;
	for($r=$start;$r<=$end;$r++){
		for($c=$start;$c<=$end;$c++){
			if($_SESSION['a'][$r][$c]==$player){
				$_SESSION['a'][$r][$c]=0;
				$_SESSION['a'][$x][$y]=$player;
			}
		}
	}
}
function editC($x,$y){
	
	$_SESSION['a'][$x][$y]=-1;
	
}


if($_SESSION['end']==0){
	$player=0;$x=0;$y=0;$x2=0;$y2=0;
	if($_SESSION['i']%2==0){
		$_SESSION['pp1']++;
		$player=1;
		$x=$_SESSION['p1r'][$_SESSION['pp1']];
		$y=$_SESSION['p1c'][$_SESSION['pp1']];
		$x2=$_SESSION['p1r2'][$_SESSION['pp1']];
		$y2=$_SESSION['p1c2'][$_SESSION['pp1']];
		
	}else{
		$_SESSION['pp2']++;
		$player=2;
		$x=$_SESSION['p2r'][$_SESSION['pp2']];
		$y=$_SESSION['p2c'][$_SESSION['pp2']];
		$x2=$_SESSION['p2r2'][$_SESSION['pp2']];
		$y2=$_SESSION['p2c2'][$_SESSION['pp2']];
	}
		disp();
		editM($player,$x,$y);
		editC($x2,$y2);
		disp();
		
		?>
		<script type="text/javascript">
		var timeout = setTimeout("location.reload(true);",1000);
		  
		</script>
		<?php
}else{
	disp();
	dispTable();
$_SESSION['i']=-1;
$_SESSION['pp1']=-1;
$_SESSION['pp2']=-1;
$_SESSION['a']=array(
array(0,0,1,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,2,0,0)
);
	$winner=$_SESSION['winner'];
	$num=$_SESSION['num'];
	//$_SESSION['winner']=0;

		
	$query="UPDATE `gameboard` SET `winner`='$winner' WHERE `id`='$num'";
	if($run=mysqli_query($mysqli,$query)){
	}else{
		echo 'Error Occured';
	}
	
	echo '<span class="win-disp"><br>player '.$winner.' Won the Game<a href="trial-exec.php" style="color:rgb(242, 9, 25);"><b> Wanna Play with other</b></span>';

		?>
		
		<script type="text/javascript">
			
			clearTimeout(timeout);
	</script>
	<?php
}

?>


<script src="js/jquery.js"></script>
</body>
</html>