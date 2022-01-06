<?php
session_start();

    include("connection.php");
    include("functions.php");
    
    $user_data = check_login_teacher($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index Page</title>
    </head>
    <body>
        <style type="text/css"> 
            body { 
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                background-color: #ECECEC;
            }
            #header{
                width: 100%;
                height: 80px;
                background-color: #F3D250;
                text-align: center;
                padding: 20px 0;
            }
            #box1{
                background-color: #F78888;
                width: 350px;
                padding: 20px;
                border-radius: 25px;
                margin-left: 5%;
                float: left;
                justify-content: center;
                margin-top: 50px;
            }
            #box2{
                background-color: #F78888;
                width: 850px;
                height: 500px;
                padding: 20px;
                border-radius: 25px;
                margin-right: 5%;
                float: right;
                justify-content: center;
                margin-top: 50px;
            }
            #box3{
                overflow: auto;
                width: 100%;
                height: 420px;
            }
            #button{
                padding: 10px;
                width: 100px;
                color: white;
                background-color: #2ba2fc;
                border: none;
            }
            #button:hover {
                background-color: #0091ff;
            }
            #text{
                width: 100%;
                padding: 10px 10px;
                margin: 8px 0;
                display: inline-block;
                box-sizing: border-box;
            }
            table, th, td {
                border: 1px solid black;
            }
            table{
                width: 100%
            }
            .tab {
                overflow: hidden;
                background-color: #f1f1f1;
            }
            .tab button {
                background-color: inherit;
                width: 33.33%;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 17px;
            }
            .tab button:hover {
                background-color: #ddd;
            }
            .tab button.active {
                background-color: #ccc;
            }
            .tabcontent {
                display: none;
                padding: 6px 12px;
            }
        </style>
        
        <script>
            function openCity(evt, sortType) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(sortType).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
        
        <div id = "header">
            <h1><?php echo $user_data['teacher_firstname']; ?>'s Passbook Monitor</h1>
        </div>
        
        <div id = "box1">
            <h2>Record Sort</h2>
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Name')">Name</button>
                <button class="tablinks" onclick="openCity(event, 'Date/Time')">Date/Time</button>
                <button class="tablinks" onclick="openCity(event, 'Location')">Location</button>
            </div>

            <div id="Name" class="tabcontent">
                <h3>Name</h3>
                <form method ="post">
                    <label>Student First Name:</label><br>
                    <input id="text" type="text" name="student_firstname" placeholder="Jane"><br>
                    <label>Student Last Name:</label><br>
                    <input id="text" type="text" name="student_lastname" placeholder="Doe"><br>
                    <input type="hidden" value="name" name="form_type">
                    <input id="button" type="submit" value="Filter"><br>
                </form>
            </div>

            <div id="Date/Time" class="tabcontent">
                <h3>Date/Time (Departure)</h3>
                <form method ="post">
                    <label>Date (YYYY-MM-DD):</label><br>
                    <input id="text" type="text" name="date" placeholder="2020-01-23"><br>
                    <label>Start Time (HH:MM):</label><br>
                    <input id="text" type="text" name="tStart" placeholder="08:00"><br>
                    <label>End Time (HH:MM):</label><br>
                    <input id="text" type="text" name="tEnd" placeholder="15:30"><br>
                    <input type="hidden" value="dateTime" name="form_type">
                    <input id="button" type="submit" value="Filter">
                </form>
            </div>

            <div id="Location" class="tabcontent">
                <h3>Location</h3>
                <form method ="post">
                    <label>Location:</label><br>
                    <input id="text" type="text" name="destination" placeholder="bathroom"><br>
                    <input type="hidden" value="location" name="form_type">
                    <input id="button" type="submit" value="Filter"><br>
                </form>
            </div>
            <center>
                <form method ="post">
                    <input type="hidden" value="outNow" name="form_type">
                    <input id="button" type="submit" value="Currently Out">
                </form>
                <form method ="post">
                    <input type="hidden" value="all" name="form_type">
                    <input id="button" type="submit" value="All Signouts">
                </form>
            </center>
        </div>
        
        <div id ="box2">
            <h2>Travel Record</h2>
            <div id ="box3">
                <?php
                echo '<table id="table">';
                echo "<tr><th>Student</th><th>Teacher</th><th>Destination</th><th>Departure</th><th>Return</th></tr>";

                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "login";

                    $mysqli = new mysqli($servername, $username, $password, $dbname);

                    $form_type = filter_input(INPUT_POST, 'form_type');
                    if ($form_type == "name"){
                        
                        $student_firstname = filter_input(INPUT_POST, 'student_firstname');
                        $student_lastname = filter_input(INPUT_POST, 'student_lastname');
                        
                        $result = $mysqli->query("SELECT CONCAT(s.student_firstname, ' ', s.student_lastname) AS student, CONCAT(t.teacher_firstname, ' ', t.teacher_lastname) AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                                . "FROM passbook p JOIN user_teacher t "
                                                . "ON p.teacher_code = t.teacher_code "
                                                . "JOIN user_student s "
                                                . "ON p.student_id = s.student_id "
                                                . "WHERE s.student_lastname = '". $student_lastname ."' AND s.student_firstname = '". $student_firstname ."' "
                                                . "ORDER BY p.departure_time DESC");

                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            if ($row['rtime'] == NULL){
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>OUT</td></tr>';
                            }
                            else{
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>'. $row["rtime"] .'</td></tr>';
                            }
                        }
                    }
                    elseif ($form_type == "dateTime"){
                        
                        $date = filter_input(INPUT_POST, 'date');
                        $tStart = filter_input(INPUT_POST, 'tStart');
                        $tEnd = filter_input(INPUT_POST, 'tEnd');
                        
                        $tStart = $date . " " . $tStart . ":00"; 
                        $tEnd = $date . " " . $tEnd . ":00";
                        
                        $result = $mysqli->query("SELECT CONCAT(s.student_firstname, ' ', s.student_lastname) AS student, CONCAT(t.teacher_firstname, ' ', t.teacher_lastname) AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                                . "FROM passbook p JOIN user_teacher t "
                                                . "ON p.teacher_code = t.teacher_code "
                                                . "JOIN user_student s "
                                                . "ON p.student_id = s.student_id "
                                                . "WHERE p.departure_time BETWEEN '". $tStart ."' AND '". $tEnd ."' "
                                                . "ORDER BY p.departure_time DESC");

                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            if ($row['rtime'] == NULL){
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>OUT</td></tr>';
                            }
                            else{
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>'. $row["rtime"] .'</td></tr>';
                            }
                        }
                    }
                    elseif ($form_type == "location"){
                        
                        $destination = filter_input(INPUT_POST, 'destination');
                        
                        $result = $mysqli->query("SELECT CONCAT(s.student_firstname, ' ', s.student_lastname) AS student, CONCAT(t.teacher_firstname, ' ', t.teacher_lastname) AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                                . "FROM passbook p JOIN user_teacher t "
                                                . "ON p.teacher_code = t.teacher_code "
                                                . "JOIN user_student s "
                                                . "ON p.student_id = s.student_id "
                                                . "WHERE p.destination = '". $destination ."' "
                                                . "ORDER BY p.departure_time DESC");

                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            if ($row['rtime'] == NULL){
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>OUT</td></tr>';
                            }
                            else{
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>'. $row["rtime"] .'</td></tr>';
                            }
                        }
                    }
                    elseif ($form_type == "outNow"){
                        
                        $result = $mysqli->query("SELECT CONCAT(s.student_firstname, ' ', s.student_lastname) AS student, CONCAT(t.teacher_firstname, ' ', t.teacher_lastname) AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                                . "FROM passbook p JOIN user_teacher t "
                                                . "ON p.teacher_code = t.teacher_code "
                                                . "JOIN user_student s "
                                                . "ON p.student_id = s.student_id "
                                                . "WHERE p.return_time IS NULL "
                                                . "ORDER BY p.departure_time DESC");

                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>OUT</td></tr>';
                        }
                    }
                    else {
                        $result = $mysqli->query("SELECT CONCAT(s.student_firstname, ' ', s.student_lastname) AS student, CONCAT(t.teacher_firstname, ' ', t.teacher_lastname) AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                                . "FROM passbook p JOIN user_teacher t "
                                                . "ON p.teacher_code = t.teacher_code "
                                                . "JOIN user_student s "
                                                . "ON p.student_id = s.student_id "
                                                . "ORDER BY p.departure_time DESC");

                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            if ($row['rtime'] == NULL){
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>OUT</td></tr>';
                            }
                            else{
                                echo '<tr><td>'. $row["student"] .'</td><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>'. $row["rtime"] .'</td></tr>';
                            }
                        }
                    }
                    
                    echo "</table>";
                    $mysqli->close();
                }
                ?>
            </div>
        </div>
        
        <a href="logout.php">Logout</a>
    </body>
</html>
