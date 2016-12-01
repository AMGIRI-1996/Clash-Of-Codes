<?php
/*this file is for checking email id of user and allowing him for the event -- this opens after user clicks on the mail sent to him after registration*/
include ('connect_algodb.php');
require_once('core.php');
session_start();
    function joining_mail($email,$name){	
	$msg = "Dear ". $name."
Thank you for joining our Event.
Enjoy this Event and let us know.
-Anurag Giri";//write your message
	$headers = "From:noreply";
	$sentmail = mail ($email,"Thanks for joining us!!",$msg,$headers);
}
if (isset($_GET['email']) )
{
    $email = $_GET['email'];
}else echo 'email prob';
if (isset($_GET['key']))//The Activation key will always be 32 since it is MD5 Hash
{
    $key = $_GET['key'];
}else echo 'key pr';
if (isset($_GET['name']))
{
    $name = $_GET['name'];
}else echo 'name prob';
if (isset($email) && isset($key) && isset($name))
{

    // Update the database to set the "activation" field to null

    $query_activate_account = "UPDATE `registered` SET `activation`=NULL WHERE(`email` ='$email' AND `activation`='$key')LIMIT 1";

   
    if($result_activate_account = mysqli_query($mysqli, $query_activate_account)){

    // Print a customized message:
    
		joining_mail($email,$name);
		$_SESSION['email']=$email;
		$_SESSION['msg']='Your id is activated Successfully';
		redirect_to('login.php');

   
	}
    mysqli_close($mysqli);

} else {
        echo '<div class="errormsgbox">Error Occured .</div>';
}
?>