<?php

if(isset($_POST['login-submit'])){

    require 'dbh.inc.php';
    $userName = $_POST['mailuid'];
    // $users_mail = $_POST ['mail'];
    $password = $_POST['pwd'];

    if(empty($userName) || empty($password)){
        header("Location: ../signup.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "Select * From userstable Where user_name=? or user_email =?;";//Checking for errors of this statement below
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {     
            header("Location: ../signup.php?error=sqlerror");
            exit();
    }
    else{
        
        mysqli_stmt_bind_param($stmt,"ss",$userName,$userName);
        // Running to get results
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);//get raw data 
        if ($row = mysqli_fetch_assoc($results)) {
            $pwdCheck = password_verify($password,$row['user_pwd']);//This will take password of user and then hash and match 
            //    The above will give true or false
            
            if($pwdCheck == false) {
                header("Location: ../signup.php?error=wrongpwd");
                exit();
            }
            else if($pwdCheck == true){
                // Check if there is not any error happened.
                session_start();
                // To check if user is logged in or not
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                header("Location: ../article_submission.php?login=success");
                exit();
            }
        }
        else{//no user in database
            header("Location: ../signup.php?error=nouser");
            exit();
        }

    }
    }
}