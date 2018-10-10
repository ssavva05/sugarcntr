<?php

//logout.php

session_start();

if (isset($_SESSION)) {
    session_destroy();
}
setcookie("type", "", time() - 3600);
header("location:login.php");

//setcookie("type", "", time()-3600);
//session_destroy();
//header("location:login.php");
?>
