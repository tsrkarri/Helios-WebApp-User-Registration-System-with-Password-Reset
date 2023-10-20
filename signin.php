<?php
    $is_invalid = false;

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $mysqli=require __DIR__ ."/database_link.php";
        $sql = sprintf("SELECT * FROM users WHERE email='%s'",
                        $mysqli->real_escape_string($_POST["email"]));
        
        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        // Checking if the value is getting fetched from DB below.

        // var_dump($user);
        // exit;

        if($user){
            if(password_verify($_POST["password"],$user["password_hash"])){
                session_start();
                session_regenerate_id();
                $_SESSION["user_id"]=$user["id"];

                header("Location: home.php");
                exit;
            }
        }

        $is_invalid = true;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation_signin.js" defer></script>
    <title>Helios Project</title>
    <!-- <link rel="stylesheet" href="mvp.css"> -->
    <link rel="stylesheet" href="helios.css">
</head>
<body>
    <div class="container">
        <form id = signin method="post">
            <h1>Sign In</h1>
            <?php
            if($is_invalid) : ?>
                <em style="color:red;">Invalid Login</em>
            <?php
                endif;
            ?>
            <div class = form-group>
                <label for="email"> <b>E-Mail</b> </label>
                <input type="email" id="email" name="email" class = "form-control"
                placeholder="Enter E-Mail"value= "<?= htmlspecialchars($_POST["email"] ?? "" )?>">
            </div>
            <div class = form-group>
                <label for="password"> <b>Password</b> </label>
                <input type="password" id="password" name="password" class = "form-control" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn" >Sign In</button>
            <p>
            <a href="forgot_password.php">Forgot Password ?</a>
            <p>Are you a new user ? <a href="signup.php">Sign Up</a>
            </p>
        </form>
    </div>
</body>

</html>