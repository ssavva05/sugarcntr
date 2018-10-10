<?php
session_start();
include("database.php");


if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE["type"])) {
        //create session
        $_SESSION['user'] = $_COOKIE["type"];
        header("location:index.php");
        
    }
    header("location:login.php");
}






/*
  if (!isset($_SESSION['user'])) {
  //    header("location:login.php");
  //}
  $_SESSION['user'] = session_id();
  }
 * */


/*
  if (isset($_SESSION['user'])) {
  //    header("location:login.php");
  //}
  $_SESSION['user'] = session_id();
  }
 */
//if(!isset($_COOKIE["type"]))
//{
//header("location:login.php");
//}

$uid = $_SESSION['user'];  // set your user id settings
$datetime_string = date('c', time());

if (isset($_POST['action']) or isset($_GET['view'])) {
    if (isset($_GET['view'])) {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($connection, $_GET["start"]);
        $end = mysqli_real_escape_string($connection, $_GET["end"]);

        $result = mysqli_query($connection, "SELECT `id`, `start` ,`end` ,`title` FROM  `events` where (date(start) >= '$start' AND date(start) <= '$end') and uid='" . $uid . "'");
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
        echo json_encode($events);
        exit;
    } elseif ($_POST['action'] == "add") {
        mysqli_query($connection, "INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `uid` 
                    )
                    VALUES (
                    '" . mysqli_real_escape_string($connection, $_POST["title"]) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "',
                    '" . mysqli_real_escape_string($connection, $uid) . "'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"' . mysqli_insert_id($connection) . '"}';
        exit;
    } elseif ($_POST['action'] == "update") {
        mysqli_query($connection, "UPDATE `events` set 
            `start` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "', 
            `end` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "' 
            where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
        exit;
    } elseif ($_POST['action'] == "delete") {
        mysqli_query($connection, "DELETE from `events` where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
        if (mysqli_affected_rows($connection) > 0) {
            echo "1";
        }
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Sugar Level Mesures</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/punch.js"></script>
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">
        <link rel="stylesheet" type="text/css" href="css/fullcalendar.css">
        <link rel="stylesheet" type="text/css" href="css/fullcalendar.print.css" media="print">
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/fullcalendar.js"></script>
        <script type="text/javascript" src="js/script.js"></script>

        <style>
            body{ 
                background: url('pic/h.png') no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            .second-button{
                margin-top: 0.7em;
                margin-right: 0.7em;
                float:right;
            }
            .navbar-brand{
                color: #eff9f0;
            }
            .navbar-inverse .navbar-brand{
                color: #eff9f0;
            }
            .nav > li > a:hover{
                background-color:#eff9f0;
            }
            .fc{
                background-color:rgba(14, 128, 40, 0.17);
            }

            .fc-unthemed th, .fc-unthemed td, .fc-unthemed thead, .fc-unthemed tbody, .fc-unthemed .fc-divider, .fc-unthemed .fc-row, .fc-unthemed .fc-content, .fc-unthemed .fc-popover, .fc-unthemed .fc-list-view, .fc-unthemed .fc-list-heading td {
                border-color:rgba(58, 58, 58, 0.57);
            }
            /*
            .navbar-header{
                width:100%;
            }
            .navbar {
                  background-color: rgba(45, 45, 45, 0.4);
                  background: rgba(45, 45, 45, 0.4);
                  border-color: rgba(45, 45, 45, 0.4);
              }
              .navbar li { 
                  rgba(245, 245, 245, 0.4);
              } */

        </style>
    </head>
    <body>

        <!-- add navbar in this div -->
        <div class ="row">

            <nav class="navbar nav navbar-inverse navbar-fixed-top">
                <div class="container">

                    <a class="navbar-brand"> Sugar Level Mesures</a>

                    <ul class="second-button">
                        <form>
                            <!--<form class="navbar-form">-->
                            <!--<button class="btn btn-info ">Back</button>-->
                            <a type="button" class="btn btn-danger" href="logout.php">Sign Out</a>
                        </form>
                    </ul>
                    <div>
                        </nav>

                    </div>

                    <br />
                    <br />
                    <br />
                    <div class ="row">
                        <div class ="container">
                            <h4 id="nsse" align="center"> Advice of the Day. </h4>
                            <h5 id="nsse" align="center"> Hypoglycemia: 70 mg/dL or below. </h5>
                            <h5 id="nsse" align="center"> Hyperglycemia: 180 mg/dL is above normal and above 300 mg/dL is severe. </h5>
                            <script>
                                var source = new EventSource('events.php');
                                source.addEventListener('message', function (e) {
                                    console.log(e.data);
                                    document.getElementById("nsse").innerHTML = e.data + '<br>';
                                }, false);
                            </script>
                        </div>
                    </div>

                    <div class ="row">
                        <!-- add calander in this div -->
                        <div class="container">
                            <div id="calendar">
                            </div>
                        </div>

                        <!-- Modal -->
                        <div id="createEventModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Sugar Level</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Sugar Level:</label>
                                            <div class="field desc">
                                                <input class="form-control" id="title" name="title" placeholder="Sugar Level Number" type="text" value="">
                                            </div>
                                        </div>

                                        <input type="hidden" id="startTime"/>
                                        <input type="hidden" id="endTime"/>


                                        <div class="control-group">
                                            <label class="control-label" for="when" style="margin-top:5px;">Mesure Date and Time:</label>
                                            <div class="controls controls-row" id="when" style="margin-top:1px;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="calendarModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Event Details</h4>
                                    </div>
                                    <div id="modalBody" class="modal-body">
                                        <h4 id="modalTitle" class="modal-title"></h4>
                                        <div id="modalWhen" style="margin-top:5px;"></div>
                                    </div>
                                    <input type="hidden" id="eventID"/>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <div align="center">
                            <h4> </h4>  
                            <h5>&copy; Created by: ssavva05 , <?php echo date("Y"); ?> , 
                                Contact information: <a href="mailto:ssavva05@ucy.ac.cy">
                                    ssavva05@ucy.ac.cy</h5>
                        </div>       
                    </footer> 
                    </body>
                    </html>