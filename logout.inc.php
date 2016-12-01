<?php
require_once('core.php');
session_start();
session_destroy();
unset($_SESSION['email']);
if(isset($_SESSION['email'])) echo 'still log in'; 
redirect_to('login.php');
?>