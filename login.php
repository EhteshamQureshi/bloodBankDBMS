<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create Account to Submit Article</title>
</head>

<body>
    <header>

    </header>
    <div style=" display: flex; align-items: center; justify-content: center; " class="setform">
        <form action="includes/signup.inc.php" method="post">
            <br><br>
            <h2>Fill in Details Here</h2><br>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<p style="color:red;"> Please Fill in all fields!</p>';
                } else if ($_GET['error'] == "invalidmail") {
                    echo '<p style="color:red;"> Invalid username or e-mail!</p>';
                } else if ($_GET['error'] == "Invalidmail") {
                    echo '<p style="color:red;"> nvalid username or e-mail!</p>';
                } else if ($_GET['error'] == "Invaliduid") {
                    echo '<p style="color:red;"> nvalid username or e-mail!</p>';
                } else if ($_GET['error'] == "passwordcheck") {
                    echo '<p style="color:red;"> Your passwords do not match!</p>';
                } else if ($_GET['error'] == "usertaken") {
                    echo '<p style="color:red;"> Username is already taken!</p>';
                } else if ($_GET['signup'] == "success") {
                    echo '<p> Signup successful!</p>';
                }
            }
            ?>
            <br><label>Enter UserName :</label>
            <input type="text" name="uid" placeholder="Username" required><br><br>
            <label>Enter Email :</label>
            <input type="email" name="mail" placeholder="E-mail" required><br><br>
            <label>Enter Password :</label>
            <input type="password" name="pwd" placeholder="Password" required><br><br>
            <label>Confirm Password :</label>
            <input type="password" name="cnfmpwd" placeholder="Confirm Password" required><br><br>
            <button type="submit" name="signup-submit" class="view-preface">Create Account</button>
            <br><br>
            <h3>Already Have Account then Login Here</h3><br>
            <a href="signup.php"><button class="view-preface">Login Here</button></a>
        </form>


    </div>
</body>

</html>