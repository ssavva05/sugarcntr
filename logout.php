<?php

//logout.php
setcookie("type", "", time()-3600);
session_destroy();
header("location:login.php");

?>
