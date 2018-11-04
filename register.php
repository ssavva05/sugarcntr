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
        <style>
            body{ 
                background: url('pic/b.jpg') no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

        </style>

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
                <h3>Select Your Diabetes Type: </h3>
                <input type="radio" name="st" value="A" > Type A<br>
                <input type="radio" name="st" value="B" checked> Type B<br>
                <br />
              
                    <label onclick="document.getElementById('Box').checked = false;">
                        <input type="checkbox" checked = true name="Box" value="box" />
                        By checking this checkbox you Accept The User Agreement. By using our website, you agree to the placement of these cookies. To learn more, read our Privacy Policy. 
                    </label>
               
                <br />
                <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
                <br />
                <div id="message" style= "color:#FF0000;" ></div>
            </form>
        </div> <!-- /container -->

        <!-- The AJAX login script -->
        <script src="js/create.js"></script>
        <script>document.getElementById("submit").disabled = true;</script>

    </body>
</html>