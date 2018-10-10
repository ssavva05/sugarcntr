<?php
session_start();

if (isset($_SESSION['username'])) {
    header("location:index.php");
}

if (isset($_COOKIE["type"])) {
    header("location:index.php");
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/punch.js"></script>
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">

    </head>

    <body>
        <div class="container">

            <form class="form-signin" name="form1" method="post" action="createuser.php">
                <br />
                <h2 class="form-signin-heading">Create Account</h2>
                <br />
                <br />
                <input name="myusername" id="myusername" type="name" class="form-control" placeholder="Name" autofocus>
                <br />
                <input name="myemail" id="myemail" type="email" class="form-control" placeholder="Email ID" autofocus>
                <br />
                <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Confirm Password">
                <br />
                <input name="retypepwd" id="retypepwd" type="password" class="form-control" placeholder="Re-Type Password">
                <br />
                <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
                <br />
                <div id="message"></div>
            </form>
        </div> <!-- /container -->

        <!-- The AJAX login script -->
        <script src="js/create.js"></script>
        <script>document.getElementById("submit").disabled = true;</script>

    </body>
</html>