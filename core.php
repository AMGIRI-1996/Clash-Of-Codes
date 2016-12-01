<?php
/*redirect function*/
function redirect_to($redirect_page){?>
	<script>
		
			window.location.assign("<?php echo $redirect_page;?>");
		
	</script>	
	<?php
}

/*for making new files*/
function make_file($data,$f_name){
	
	$fp=fopen($f_name,"w");
	fclose($fp);
	file_put_contents($f_name,$data);
	

}
?>