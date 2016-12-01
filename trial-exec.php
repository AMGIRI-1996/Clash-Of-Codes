<?php
/*for selecting opponent*/
session_start();

require_once('connect_algodb.php');
require_once('countdown.php');
require_once('core.php');

if(!isset($_SESSION['email'])) redirect_to('games.php');

if(isset($_SESSION['email'])&&isset($_SESSION['error'])){
	$userid1=$_SESSION['email'];
	
	$error=$_SESSION['error'];
	
	if($error==1){
		header('Location:index.php');
	}else{
		//list of available players-take from table
		$quiry="SELECT * FROM `players` ";
		if($Squiry=mysqli_query($mysqli,$quiry)){
?>
<div class="page-b" id="select-player">
<span class="biggest">SELECT Your Opponent to Play with...</span><br><br><br>
<form action="trial-exec.php" method="post">

<select name="player2"  id="opp-list">
<?php
			while($row=mysqli_fetch_assoc($Squiry)){
				if($row['email']==$userid1)continue;
?>	
	<option   value="<?php echo $row['email'];?>"><?php echo $row['name'].'-'. $row['roll'];?></option>
<?php
			}	
?>
</select>
<input type="submit" id="opp-select" value="Play"/>
</form>	
</div>
<?php
		}
		
	}
	if(isset($_POST['player2'])){
		$p1name=$_SESSION['name'];
		$p1roll=$_SESSION['roll'];
		$_SESSION['player2']=$_POST['player2'];
		$player2=$_POST['player2'];
		$player1=$_SESSION['email'];
		$_SESSION['player1']=$_SESSION['email'];
		$query = "SELECT * FROM `registered` WHERE `email` = '$player2' LIMIT 1 ";
                if($query_run = mysqli_query($mysqli,$query)){	                    
						$row = mysqli_fetch_assoc($query_run);
						$p2name= $row['name'];
						$p2roll= $row['roll'];
						$_SESSION['fplayer2']=$p2name.'-'.$p2roll;
						$_SESSION['fplayer1']=$p1name.'-'.$p1roll;
				}
		//INSERT INTO `gameboard`(`id`, `timestamp`, `with`) VALUES ([value-1],[value-2],[value-3])
		$quiry=" INSERT INTO `gameboard`(`id`,`user`,`with`) VALUES ('','$p1name-$p1roll','$p2name-$p2roll')";
		if($Squiry=mysqli_query($mysqli,$quiry)){
		
			//SELECT * FROM `gameboard` WHERE `with`='$userid1-$player2'
			$quiry="SELECT `id` FROM `gameboard` WHERE `user`='$p1name-$p1roll' ORDER BY id DESC";
			if($Squiry=mysqli_query($mysqli,$quiry)){
				$row=mysqli_fetch_assoc($Squiry);
				$_SESSION['num']=$row['id'];
				mkdir($_SESSION['num']);
				//echo $_SESSION['num'];
				redirect_to('play.php');
			}
			
			
		}else echo 'insert problem';
		
		//header to play
	}
}else{
	//header to index
}

//echo 'hi';


?>
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
