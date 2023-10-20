<?php
$is_invalid_otp = false;
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST"){
        if($_POST["code"] == $_SESSION["code"]){
            session_regenerate_id();
            header("Location: change_password.php");
            exit;
        }

    $is_invalid_otp = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Project - Forgot Password</title>
    <link rel="stylesheet" href="helios.css">
</head>

<body>
    <div class="container">    
        <form id=forgot_password method="post">
            <h1>OTP Verification Code</h1>
            <p>Enter your verification code sent to <?= htmlspecialchars($_SESSION["email"])?></p>
            
            <?php
                if($is_invalid_otp) : ?>
                    <em style="color:red;">Invalid OTP.</em>
            <?php
                endif;
            ?>
            <div class="form-group">
                <label for="code"> <b>Enter OTP Verification Code</b> </label>
                <input type="text" id="code" name="code" placeholder="Enter OTP here" class="form-control">
            </div>
            <button type="submit" class="btn">Verify OTP</button>
        </form>
    </div>
</body>

</html>