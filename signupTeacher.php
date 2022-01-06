<?php
session_start();

    include("connection.php");
    include("functions.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $teacher_id = filter_input(INPUT_POST, 'teacher_id');
        $teacher_code = filter_input(INPUT_POST, 'teacher_code');
        $teacher_lastname = filter_input(INPUT_POST, 'teacher_lastname');
        $teacher_firstname = filter_input(INPUT_POST, 'teacher_firstname');
        //echo $username;
        //echo $password;
        //echo $teacher_code;
        //echo $teacher_id;
        
        if(!empty($username) && !empty($password)){
            //save to login
            echo $teacher_id;
            $query = "INSERT INTO user_teacher (teacher_id, username, password, teacher_code, teacher_lastname, teacher_firstname) VALUES ('$teacher_id', '$username', '$password', '$teacher_code', '$teacher_lastname', '$teacher_firstname')";
            
            mysqli_query($con, $query);
            
            //commented out to not redirect page
            header("Location: login.php");
            die;
        }
        else{
            echo "Please enter vaulid information";
        }
        
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teacher Sign Up</title>
    </head>
    <body>
        <style type="text/css"> 
            body { 
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                background-color: #ECECEC;
            }
            #box{
                background-color: #F78888;
                width: 300px;
                padding: 20px;
                border-radius: 25px;
                float: none;
                margin: 0 auto;
                justify-content: center;
                margin-top: 50px;
            }
            #button{
                padding: 10px;
                width: 150px;
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
            #header{
                width: 100%;
                height: 80px;
                background-color: #F3D250;
                text-align: center;
                padding: 20px 0;
            }
        </style>
        <div id="header">
            <h1>Teacher Sign Up Page</h1>
        </div>
        
        <div id = "box">
            <form method ="post">
                <h2>Teacher Sign Up</h2>
                <label>Username:</label><br>
                <input id="text" type="text" name="username" placeholder="Username"><br>
                <label>Password:</label><br>
                <input id="text" type="password" name="password" placeholder="Password"><br>
                <label>Teacher ID:</label><br>
                <input id="text" type="number" name="teacher_id" placeholder="0000000"><br>
                <label>Teacher Code:</label><br>
                <input id="text" type="text" name="teacher_code" placeholder="teacher_code"><br>
                <label>Last Name:</label><br>
                <input id="text" type="text" name="teacher_lastname" placeholder="Last Name"><br>
                <label>First Name:</label><br>
                <input id="text" type="text" name="teacher_firstname" placeholder="First Name"><br>
                
                <input id="button" type="submit" value="Teacher Sign up"><br>
                
                <a href="login.php">Login</a>
            </form>
        </div>
        
    </body>
</html>
