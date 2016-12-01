<?php
session_start();

require_once('connect_algodb.php');
//require_once('countdown.php');
require_once('core.php');
if(isset($_POST['player2'])){
		
		$_SESSION['player2']=$_POST['player2'];
		$_SESSION['player1']=$_POST['player1'];
		$player1=$_POST['player1'];
		$player2=$_POST['player2'];
		$query = "SELECT * FROM `registered` WHERE `email` = '$player2' LIMIT 1 ";
                if($query_run = mysqli_query($mysqli,$query)){	                    
						$row = mysqli_fetch_assoc($query_run);
						$p2name= $row['name'];
						$p2roll= $row['roll'];
						$_SESSION['fplayer2']=$p2name.'-'.$p2roll;
						
				}
		$query = "SELECT * FROM `registered` WHERE `email` = '$player1' LIMIT 1 ";
                if($query_run = mysqli_query($mysqli,$query)){	                    
						$row = mysqli_fetch_assoc($query_run);
						$p1name= $row['name'];
						$p1roll= $row['roll'];
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


?>



<form  method="post">

<select name="player1"  id="opp-list">
<?php
$quiry="SELECT * FROM `players` ";
$Squiry=mysqli_query($mysqli,$quiry);
			while($row=mysqli_fetch_assoc($Squiry)){
				
?>	
	<option   value="<?php echo $row['email'];?>"><?php echo $row['name'].'-'. $row['roll'];?></option>
<?php
			}	
?>
</select>
<select name="player2"  id="opp-list">
<?php
$quiry="SELECT * FROM `players` ";
$Squiry=mysqli_query($mysqli,$quiry);
			while($row=mysqli_fetch_assoc($Squiry)){
		
?>	
	<option   value="<?php echo $row['email'];?>"><?php echo $row['name'].'-'. $row['roll'];?></option>
<?php
			}	
?>
</select>
<input type="submit" id="opp-select" value="Play"/>
</form>	