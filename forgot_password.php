<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Project - Forgot Password</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation_fp.js" defer></script>
    <link rel="stylesheet" href="helios.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
</head>

<body>
    <div class = "container">
    <form id=forgot_password action="reset_request.php" method="post">
        <h1>Forgot Password</h1>
        <p>Enter your registered email to receive password reset instructions</p>
        <div class="form-group">
            <label for="email"> <b>E-Mail</b> </label>
            <input type="email" id="email" name="email" placeholder="Enter your Email Address" class="form-control">
        </div>
        <br>
        <button type="submit" class="btn">Send Email</button>
        <p>Remember your password? Back to <a href="signin.php">Sign In</a></p>
    </form>
    </div>
</body>

</html>