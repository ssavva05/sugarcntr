<?php
/**
* This page will save username/password data in cookies if remember box is checked
* If remember box is not checked, cookies will be cleared/deleted.
* Website: www.TutorialsClass.com
* Script Link: 
**/

if(!empty($_POST["remember"])) {
	setcookie ("username",$_POST["username"],time()+ 3600);
	setcookie ("password",$_POST["password"],time()+ 3600);
	echo "Cookies Set Successfuly";
} else {
	setcookie("username","");
	setcookie("password","");
	echo "Cookies Not Set";
}

?>

<p><a href="page1.php"> Go to Login Page </a> </p>
