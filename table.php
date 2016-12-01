<?php
	require_once('connect_algodb.php');
	require_once('countdown.php');
	require_once('core.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GameBoard</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
			.pos{
				position : absolute;
				top : 20%;
				width :70%;
				left : 15%;
			}
			body{
				background-image : url("img/w-4.jpg");
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size:100% 100%;
			}
			
	</style>
  </head>
  <body>
  <a href="index.php"><span style="color:white; position:fixed; right:30; top:30; font-size:2em; font-family:cursive">Home</span></a>
    
		<div class="container pos back" style="opacity:0.8">
			<div class="well">
				<table class="table table-hover">
					 <tr>
					    <td style="width:10%;"><b>GAME BOARD</b></td>
					    <td style="width:30%;"><b>PLAYER 1</b></td>
					    <td style="width:30%;"><b>PLAYER 2</b></td>
					    <td style="width:30%;"><b>WINNER</b></td>
					  </tr>
					  <?php
					  $sql = "SELECT * FROM gameboard  ORDER BY `id` DESC ";
					$result = mysqli_query($mysqli, $sql);
					
					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    $i=1;
					    while($row = mysqli_fetch_assoc($result)) {
					    if($i%2 == 0){ $i=$i+1;?>
						  <tr class="info">
							<td><?php echo $row["id"];?></td>
						    	<td><?php echo $row["user"];?></td>
						    	<td><?php echo $row["with"];?></td>
						    	<td><?php echo $row["winner"];?></td>
						  </tr>
					  <?php }else{$i=$i+1; ?>
						  <tr class="danger">
						 	<td><?php echo $row["id"];?></td>
						    	<td><?php echo $row["user"];?></td>
						    	<td><?php echo $row["with"];?></td>
						    	<td><?php echo $row["winner"];?></td>
						  </tr>
					<?php }
						 }
					} else {
					    echo "0 results";
					}

					mysqli_close($conn);
					?>
				</table>
			</div>
		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>