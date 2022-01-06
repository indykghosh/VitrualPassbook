<?php
//NEED TO CHANGE USER_ID TO STUDENT_ID
function  check_login_student($con){
    
    if(isset($_SESSION['student_id'])){
        
        $id = $_SESSION['student_id'];
        $query = "SELECT * FROM user_student WHERE student_id = '$id' limit 1";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            
            $user_data = mysqli_fetch_assoc($result);
            return$user_data;
        }
        
    }
    
    //redirect to login
    header("Location: login.php");
    die;
        
}

function  check_login_teacher($con){
    
    if(isset($_SESSION['teacher_id'])){
        
        $id = $_SESSION['teacher_id'];
        $query = "SELECT * FROM user_teacher WHERE teacher_id = '$id' limit 1";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            
            $user_data = mysqli_fetch_assoc($result);
            return$user_data;
        }
        
    }
    
    //redirect to login
    header("Location: login.php");
    die;
        
}

?>