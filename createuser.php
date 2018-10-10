<?php

ob_start();
session_start();

include_once 'database.php';
$tbl_name = "members"; // Table name
//$salt = "batman is here"; // For SHA1 hashing
//
        //
	// Connect to server and select databse.
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 		
//        
//mysql_select_db("$db_name")or die("cannot select DB");
// Define $myusername and $mypassword 
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];
$myemail = $_POST['myemail'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myemail = stripslashes($myemail);
//$myusername = mysql_real_escape_string($myusername);	
//$mypassword = mysql_real_escape_string($mypassword);
//$myemail = mysql_real_escape_string($myemail);
//	Hashing the password using SHA1 and salt="batman is here"

$mypassword = sha1($mypassword.$salt);


$sql = "SELECT * FROM $tbl_name WHERE email='$myemail'";
$result = mysqli_query($connection, $sql);

//echo "<script type='text/javascript'>alert('$result')</script>";

$count = mysqli_num_rows($result);

if ($count != 0) {
    echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Email ID already exists</div>";
} else {
    
    $uid = sha1($myemail.$salt);
    $sql = "INSERT INTO $tbl_name (`id`, `username`, `password`,`email`,`uid`) VALUES (NULL,'$myusername', '$mypassword', '$myemail', '$uid')";
    mysqli_query($connection, $sql) or die(mysqli_error($connection));
    //$_SESSION['username'] = $myusername;
    //$_SESSION['password'] = $mypassword;
    $_SESSION['user'] = sha1($myemail.$salt);
    setcookie("type", sha1($myemail.$salt), 2147483647);
    //header("location:index.php");
    echo "true";
}

ob_end_flush();

//header("location:login.php");
?>
