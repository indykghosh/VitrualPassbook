<?php
session_start();

    include("connection.php");
    include("functions.php");
    
    $user_data = check_login_student($con);
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "login";
        
        $destination = filter_input(INPUT_POST, 'destination');
        $teacher_code = filter_input(INPUT_POST, 'teacher_code');
        $student_id = $user_data['student_id'];
        $form_type = filter_input(INPUT_POST, 'form_type');
        
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        
        if($form_type == "signout"){
            $result = $mysqli->query("SELECT id FROM user_teacher WHERE teacher_code = '$teacher_code'");
            if($result->num_rows == 0) {
                //echo "Row not found";
                echo "Incorrect Teacher Code";
            } else {
                //echo "Row found";
                $query = "INSERT INTO passbook (student_id, teacher_code, destination, departure_time) VALUES ('$student_id', '$teacher_code','$destination',NOW())";

                if (mysqli_query($con, $query)){
                    //echo "Record Entered Successfully <br>";

                }else{
                    echo "Record did NOT enter <br>";
                }
            }
        }
        else{
            $query = "UPDATE passbook "
                    . "SET return_time = NOW() "
                    . "WHERE student_id= '$student_id' AND return_time IS NULL";
            
            if ($con->query($query) === TRUE) {
			echo "You have successfully arrived";
		} else {
			echo "Error updating record: " . $conn->error;
		}
        }
        $mysqli->close();
    }
    
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
                background-color: #90CCF4;
                width: 300px;
                padding: 20px;
                border-radius: 25px;
                margin-left: 5%;
                float: left;
                justify-content: center;
                margin-top: 50px;
            }
            #box2{
                background-color: #90CCF4;
                width: 900px;
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
            #return{
                padding: 5px;
                width: 100%;
                color: white;
                background-color: #2ba2fc;
                border: none;
            }
            #return:hover {
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
            #table{
                width: 100%;
            }
        </style>
            
        <div id = "header">
            <h1><?php echo $user_data['student_firstname']; ?>'s Virtual Passbook</h1>
        </div>
        
        <div id = "box1">
            <form method ="post">
                <h2>New Hall Pass</h2>
                <label>Destination:</label><br>
                
                <select name="destination" id="text">
                    <option value="bathroom">Bathroom</option>
                    <option value="front_office">Front Office</option>
                    <option value="principal">Principal Office</option>
                </select><br>
                
                <input type="hidden" value="signout" name="form_type"/>
                <!--<input id="text" type="text" name="destination" placeholder="Destination"><br>-->
                <label>Teacher Code:</label><br>
                <input id="text" type="text" name="teacher_code" placeholder="Teacher Code"><br>
                <input id="button" type="submit" value="Go">
            </form>
        </div>
        
        <div id ="box2">
            <h2>Travel Record</h2>
            <div id ="box3">
                <?php
                echo '<table id="table">';
                echo "<tr><th>Teacher</th><th>Destination</th><th>Departure</th><th>Return</th></tr>";

                $student_id = $user_data['student_id'];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "login";

                $mysqli = new mysqli($servername, $username, $password, $dbname);

                $result = $mysqli->query("SELECT t.teacher_firstname AS teacher, p.destination AS dest, p.departure_time AS depart, p.return_time AS rtime "
                                        . "FROM passbook p JOIN user_teacher t "
                                        . "ON p.teacher_code = t.teacher_code "
                                        . "WHERE p.student_id = '$student_id'"
                                        . "ORDER BY p.departure_time DESC");

                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    if ($row['rtime'] == NULL){
                        echo '<tr><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td><form method ="post"><input type="hidden" value="signin" name="form_type"/><input type="submit" value="Return" id="return"></form></td></tr>';
                    }
                    else{
                        echo '<tr><td>'. $row["teacher"] .'</td><td>'. $row["dest"] .'</td><td>'. $row["depart"] .'</td><td>'. $row["rtime"] .'</td></tr>';
                    }
                }
                echo "</table>";
                $mysqli->close();
                ?>
            </div>
        </div>
            
            <a href="logout.php">Logout</a>
            
    </body>
</html>
