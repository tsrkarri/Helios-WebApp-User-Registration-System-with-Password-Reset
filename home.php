<?php
    session_start();

    if(isset($_SESSION["user_id"])){
        $mysqli=require __DIR__ ."/database_link.php";
        $sql = "SELECT * FROM users WHERE id={$_SESSION["user_id"]}";
        
        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Project</title>
    <link rel="stylesheet" href="helios.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="container">
        <?php if(isset($user)):?>
            <h1>HOME</h1>
            <p>Welcome, <?= htmlspecialchars($user["name"]) ?></p>
            <p>You can <a href="signout.php">Sign Out</a></p>
        <?php else: 
            header("Location: signin.php");
        endif ?>
    </div>
</body>
</html>