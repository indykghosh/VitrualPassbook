<?php
session_start();

    include("connection.php");
    include("functions.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $usernameStudent = filter_input(INPUT_POST, 'usernameStudent');
        $passwordStudent = filter_input(INPUT_POST, 'passwordStudent');
        
        $usernameTeach = filter_input(INPUT_POST, 'usernameTeach');
        $passwordTeach = filter_input(INPUT_POST, 'passwordTeach');
        //echo $username;
        
        if(!empty($usernameStudent) && !empty($passwordStudent)){
            //read from database
            //echo $username;
            $query = "SELECT * FROM user_student WHERE username = '$usernameStudent' limit 1";
            
            $result = mysqli_query($con, $query);
            
            if($result){
                if($result && mysqli_num_rows($result) > 0){

                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] === $passwordStudent){
                        
                        $_SESSION['student_id'] = $user_data['student_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            
            //header("Location: index.php");
            //die;
            echo "Wrong user name or password";
        }
        elseif(!empty($usernameTeach) && !empty($passwordTeach)){
            //read from database
            //echo $username;
            $query = "SELECT * FROM user_teacher WHERE username = '$usernameTeach' limit 1";
            
            $result = mysqli_query($con, $query);
            
            if($result){
                if($result && mysqli_num_rows($result) > 0){

                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] === $passwordTeach){
                        
                        $_SESSION['teacher_id'] = $user_data['teacher_id'];
                        header("Location: teacherIndex.php");
                        die;
                    }
                }
            }
            
            //header("Location: index.php");
            //die;
            echo "Wrong user name or password";
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
        <title>Login</title>
    </head>
    <body>
        
        <style type="text/css"> 
            body { 
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                background-color: #ECECEC;
            }
            #box1{
                background-color: #90CCF4;
                width: 300px;
                padding: 20px;
                border-radius: 25px;
                margin-left: 20%;
                float: left;
                margin-top: 100px;
            }
            #box2{
                background-color: #F78888;
                width: 300px;
                padding: 20px;
                border-radius: 25px;
                float: right;
                margin-right: 20%;
                margin-top: 100px;
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
            #header{
                width: 100%;
                height: 80px;
                background-color: #F3D250;
                text-align: center;
                padding: 20px 0;
            }
            @media screen and (max-width: 1200px) {
                #box1 {
                    float: none;
                    margin: 0 auto;
                    justify-content: center;
                    margin-top: 50px;
                }
                #box2 {
                    float: none;
                    margin: 0 auto;
                    justify-content: center;
                    margin-top: 50px;
                }
            }
            
        </style>
        <div id = "header">
            <h1>Virtual Passbook Login</h1>
        </div>
        <div id = "box1">
            <form method ="post">
                <h2>Student Login</h2>
                <label>Username:</label><br>
                <input id="text" type="text" name="usernameStudent" placeholder="Username"><br>
                <label>Password:</label><br>
                <input id="text" type="password" name="passwordStudent" placeholder="Password"><br>

                <input id="button" type="submit" value="Login"><br>

                <a href="signup.php">Student Sign Up</a>
            </form>
        </div>
        
        <div id = "box2">
            <form method ="post">
                <h2>Teacher Login</h2>
                <label>Username:</label><br>
                <input id="text" type="text" name="usernameTeach" placeholder="Username"><br>
                <label>Password:</label><br>
                <input id="text" type="password" name="passwordTeach" placeholder="Password"><br>

                <input id="button" type="submit" value="Login"><br>

                <a href="signupTeacher.php">Teacher Sign Up</a>
            </form>
        </div>
        
    </body>
</html>
