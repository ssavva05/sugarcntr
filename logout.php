<?php

//logout.php


if (isset($_SESSION)) {
    setcookie("type", "", time() - 3600);
    session_destroy();
} else {
    setcookie("type", "", time() - 3600);
    header("location:login.php");
}

//setcookie("type", "", time()-3600);
//session_destroy();
//header("location:login.php");
?>
