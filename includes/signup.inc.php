<?php
if (isset($_POST['signup-submit'])) {
    //   Creating connection
     require "dbh.inc.php";

     $userName = $_POST['uid'];
     $email = $_POST['mail'];
     $pwd = $_POST['pwd'];
     $cnfmpwd = $_POST['cnfmpwd'];
    // Checking empty
     if(empty($userName) || empty($email) || empty($pwd) || empty($cnfmpwd)){
        header("Location: ../login.php?error=emptyFields&uid=".$userName."&mail=".$email);
        exit();
     }

     else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        header("Location: ../login.php?error=invalidmail=");
        exit();
     }
     else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=Invalidmail&uid=".$userName);
        exit();
     }
     else if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        header("Location: ../login.php?error=Invaliduid&mail=".$userName."&mail=".$email);
        exit();
     }
     else if($pwd !== $cnfmpwd){
         header("Location ../login.php?error=passwordcheck&uid=".$userName."&mail=".$email);
         exit();
     }
     else {
         $sql = "SELECT user_name FROM userstable WHERE user_name=?"; 
         $stmt = mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../login.php?error=sqlselecterror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$userName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            // Checking no of results
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../login.php?error=usertaken&mail=".$email);
                exit();
            }
            else{
                $sql = "INSERT INTO userstable (user_name, user_email, user_pwd) VALUES (? ,? ,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../login.php?error=sqlerror");
                exit();
                }
                else{
                    // Hashing Password for Security
                    $hashedPad = password_hash($pwd, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt,"sss", $userName, $email, $hashedPad);
                    mysqli_stmt_execute($stmt); //Inserting
                    header("Location: ../signup.php?index=success");
                    exit();
                    
                }

            }
        }
     
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../index.php");
    exit();
}