<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>

<body>
    <header>

    </header>
    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<div style=" display: flex; align-items: center; justify-content: center; ">';
        echo '<div>';
        echo '<h2>You are logged in</h2> <br> ';
        echo '<h3>To Submit Article Fill all the details</h3> <br>';
        echo '<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
                    <label for="title">Article Title:</label>
                    <input type="text" name="article-title"> <br><br>
                    <label for="title">Author 1:</label>
                    <input type="text" name="author-1"><br><br>
                    <label for="title">Author 2:</label>
                    <input type="text" name="author-2"><br><br>
                    <label for="title">Author 3:</label>
                    <input type="text" name="author-3"><br><br>
                    <label for="title">Author 4:</label>
                    <input type="text" name="author-4"><br><br>
                    <label for="fileSelect">Upload Article:</label>
                    <input type="file" name="uploadedFile">
                    <input type="submit" name="uploadBtn" value="Upload" class = "view-preface">          
                </form>';
        echo '</div>';
        echo '</div>';
        echo '<div style=" display: flex; align-items: center; justify-content: center; ">';
        echo '<form action="includes/logout.inc.php" method="post">
            <br><br>
                    <button type="submit" name="logout-submit" class="view-preface">Logout</button>
                 </form>';
        echo '</div>';
    } else {
        //If not logged in


        echo '<div style=" display: flex; align-items: center; justify-content: center; " class="setform">
                    <div > <br> <br>
                    <h3>Login First</h3> <br>';
        if (isset($_GET['error'])) {

            if ($_GET['error'] == "emptyfields") {
                echo '<p> Please Fill in all fields!</p>';
            } else if ($_GET['error'] == "wrongpwd") {
                echo '<p> Incorrect Password!</p>';
            } else if ($_GET['error'] == "nouser") {
                echo '<p> No such user exist!</p>';
            } else if ($_GET['signup'] == "success") {
                echo '<p> Signup successful!</p>';
            }
        }
        echo '<form action="includes/login.inc.php" method="post"><br><br>
                            <label >Enter Username / Email :</label>
                            <input type="text" name="mailuid" placeholder="E-mail/username"><br><br>
                            <label >Enter Password :</label>
                            <input type="password" name="pwd" placeholder="password"><br><br>
                            <button type="submit" name="login-submit" class="view-preface">Login</button><br><br>
                        </form>
                        <label>Don\'t Have Account :</label><a href="login.php"><button class="view-preface">Create Account</button></a>
                   </div>
                </div>
            ';
    }
    ?>
</body>

</html>