<?php
session_start();
include("database.php");
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = session_id();
}
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
        <title>calendar</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link  href="css/bootstrap.min.css" rel="stylesheet" >
        <link  href="css/bootstrap.min.css.map" rel="stylesheet" >
        <link href="css/fullcalendar.css" rel="stylesheet" />
        <link href="css/fullcalendar.print.css" rel="stylesheet" media="print"/>
        <script src="js/moment.min.js"></script>
        <script src="js/fullcalendar.js"></script>


        <style>
            

            body { 
                background: url('pic/h.png') no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>


    </head>
    <body>

        <br />
        <h2 align="center"><a href="#">Calendar</a></h2>
        <br />

        <h4 id="nsse" align="center"> Advice of the Day </h4>
        <br />

        <script>
            var source = new EventSource('events.php');
            source.addEventListener('message', function (e) {
                console.log(e.data);
                document.getElementById("nsse").innerHTML = e.data + '<br>';
            }, false);
        </script>

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
                            <label class="control-label" for="when" style="margin-top:5px;">When:</label>
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
        <footer>
            <div align="center">
                <h4> </h4>  
                <h5>&copy; Created by: ssavva05 , <?php echo date("Y"); ?> </h5>
                <h5>Contact information: <a href="mailto:ssavva05@ucy.ac.cy">
                        ssavva05@ucy.ac.cy</h5>
            </div>       
        </footer> 
    </body>
</html>