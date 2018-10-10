<?php
session_start();

if (isset($_SESSION['username'])) {
    header("location:index.php");
}

if (isset($_COOKIE["type"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/punch.js"></script>
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">

    </head>

    <body>
        <div class="container">
            <br />
            <form class="form-signin" name="form1" method="POST" action="checklogin.php">
                <h2 class="form-signin-heading">Please sign in</h2>
                <br />
                <br />
                <input name="myusername" id="myusername" type="email" class="form-control" placeholder="Email">
                <br />
                <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
                <!-- The checkbox remember me is implemented... automatically
                <label class="checkbox">
                  <input type="checkbox" value="remember-me"> Remember me
                </label>-->
                <br />
                <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <br />
                <div id="message"></div>
            </form>
            <br />
            <a href="register.php" id="create" class="btn btn-lg btn-default">Create Account</a>

        </div> <!-- /container -->


        <!-- The AJAX login script -->
        <script src="js/login.js"></script>

    </body>
</html>