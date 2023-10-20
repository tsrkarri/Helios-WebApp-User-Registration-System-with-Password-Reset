<?php
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $password_hash=password_hash($_POST["password"],PASSWORD_DEFAULT);

    $mysqli=require __DIR__."/database_link.php";

    if ($mysqli->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }

    $sql = sprintf("UPDATE users SET password_hash='$password_hash' WHERE email='%s'",
                    $mysqli->real_escape_string($_SESSION["email"]));
    
    $stmt=$mysqli->stmt_init();

    if(!$stmt->prepare($sql)){
        die("SQL ERROR : ".$mysqli->error);
    }
    if ($stmt->execute()) {
        header("Location: change_password_success.html");
        exit;
    } else {
    echo "Error updating record: " . $mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Project - Forgot Password</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation_changepassword.js" defer></script>
    <link rel="stylesheet" href="helios.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="container">
        <form id=change_password method="post" class="form-group">
            <h1>Change Password</h1>
            <p>Enter your new password below to change for the mail <?= htmlspecialchars($_SESSION["email"])?></p>
            <div class="form-group">
                <label for="password"> <b>New Password</b> </label>
                <input type="password" id="password" name="password" placeholder="Enter New Password" class="form-control">
            </div>
            <div class="form-group">
                <label for="re_password"> <b>Repeat Password</b> </label>
                <input type="password" id="re_password" name="re_password" placeholder="Repeat New Password" class="form-control">
            </div>
            <button type="submit" class="btn">Change Password</button>
        </form>
    </div>
</body>

</html>