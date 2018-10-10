<?php

ob_start();
session_start();

include_once 'database.php';
$tbl_name = "members"; // Table name

$myemail = $_POST['myusername'];
// Define $myusername and $mypassword 
//$myemail = $value;
$mypassword = $_POST['mypassword'];
// To protect MySQL injection
$myusername = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);
$mypassword = sha1($mypassword . $salt);

$sql = "SELECT * FROM $tbl_name WHERE email='$myusername' and password='$mypassword'";
$result = mysqli_query($connection, $sql);

// rowCount() is counting table row
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//print_r($_POST); 
//echo "<script type='text/javascript'>alert('".$row['email']."')</script>";
// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

    // Register $myusername, $mypassword and print "true"

    echo "true";
    $myemail = $row['email'];
    $_SESSION['password'] = 'mypassword';

    $_SESSION['user'] = sha1($myemail . $salt);
    $myusername = $row['username'];
    $_SESSION['name'] = $myusername;
    $st = $row['st'];
    $_SESSION['st']= $st;
    //////////////////////////// //2147483647//
    setcookie("type", sha1($myemail . $salt), 2147483647);
    setcookie("name", $myusername, 2147483647);
    setcookie("st", $st, 2147483647);
} else {
    //return the error message
    echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Wrong Username or Password</div>";
}

ob_end_flush();
?>
