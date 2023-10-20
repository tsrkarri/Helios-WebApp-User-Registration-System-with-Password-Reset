<?php
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        if(empty($_POST["name"])){
            die("Name is required !!!!");
        } else if(empty($_POST["designation"])){
            die("Designation is required !!!!");
        } else if ( ! filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            die("valid email is required !!!");
        } else if((strlen($_POST["password"]) < 8)){
            die("Password must be atleast 8 characters");
        }else if(! preg_match("/[a-z]/i",$_POST["password"])){
            die("Password must have atleast one letter");
        }else if(! preg_match("/[1-9]/",$_POST["password"])){
            die("Password must have atleast one number");
        }else if($_POST["password"]!==$_POST["re_password"]){
            die("Passwords must match !!");
        }

        if ($_POST["isafcstaff"]=="n"){
            if(!$_POST["ma"]){
                die("Member Association Details are required for NON-AFC Staff..Go Back and Try Again");
            }
        }else if($_POST["isafcstaff"]=="y"){
            $_POST["ma"]="";
            if(!str_ends_with($_POST["email"],"the-afc.com")){
                die("Enter AFC E-Mail");
            }
        }

        $password_hash=password_hash($_POST["password"],PASSWORD_DEFAULT);
        
        // Connection to database...

        $mysqli=require __DIR__."/database_link.php";
        $sql = "INSERT INTO users (name, email, password_hash, designation, isafcstaff, ma)
                VALUES (?,?,?,?,?,?)";
        
        $stmt=$mysqli->stmt_init();

        if(!$stmt->prepare($sql)){
            die("SQL ERROR : ".$mysqli->error);
        }
        $stmt->bind_param("ssssss",$_POST["name"],
                                $_POST["email"],
                                $password_hash,
                                $_POST["designation"],
                                $_POST["isafcstaff"],
                                $_POST["ma"]);

        if($stmt->execute()){
            header("Location: signup_success.html");
            exit;
        }else{
            die($mysqli->error." ".$mysqli->errno);
        }



        //testing if appeared on screen
        //print_r($_POST);
        // var_dump($password_hash);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Project</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation_signup.js" defer></script>
    <script>
        function displayDivDemo(id, elementValue) {
            document.getElementById(id).style.display = elementValue.value == 'n' ? 'block' : 'none';
        }
    </script>
    <link rel="stylesheet" href="helios.css">
    <style>
        #isafcstaffno {
            display: none;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="container">
        <form id="signup" action="signup.php" method="post">
            <h1>Sign Up</h1>
            <div class=form-group>
                <label for="name"> <b>Name</b> </label>
                <input type="text" id="name" name="name" class=form-control>
            </div>
            <div class=form-group>
                <label for="designation"> <b>Designation</b> </label>
                <input type="text" id="designation" name="designation" class=form-control>
            </div class=form-group>
            <!-- <div id="isafcstaff">
            <label for="isafcstaff" id="isafcstaff">Are you AFC Staff ?</label>
            <input type="radio" id="afcyes" name="isafcstaff" value="y">
            <label for="afcyes"> Yes </label>
            <input type="radio" id="afcno" name="isafcstaff" value="n">
            <label for="afcno"> No </label>
        </div> -->
            <div class=form-group>
                <label for="isafcstaff"><b>Are you AFC Staff ?</b></label>
                <select name="isafcstaff" id="isafcstaff" required class=form-control
                    onchange="displayDivDemo('isafcstaffno', this)">
                    <option value="y">Yes</option>
                    <option value="n">No</option>
                </select>
            </div>
            <div class=form-group id="isafcstaffno">
                <label for="ma"><b>Member Association</b></label>
                <input type="text" name="ma" id="ma" class=form-control required>
            </div>
            <div class=form-group>
                <label for="email"> <b>E-Mail (If AFC Staff, provide AFC Email Only)</b> </label>
                <input type="email" id="email" name="email" class=form-control>
            </div>
            <div class=form-group>
                <label for="password"> <b>Password</b> </label>
                <input type="password" id="password" name="password" class=form-control>
            </div>
            <div class=form-group>
                <label for="re_password"> <b>Re-Enter Password</b></label>
                <input type="password" id="re_password" name="re_password" class=form-control>
            </div>
            <button type="submit" class="btn"><b>Sign Up</b></button>
            <p>Already Registered? <a href="signin.php">Sign In</a></p>
        </form>
    </div>
</body>

</html>