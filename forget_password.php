<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


/*
-----------------------------------
DATABASE CONNECTION
-----------------------------------
*/

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "wil_company"
);

if(!$conn){

    die("Database Connection Failed");

}


/*
-----------------------------------
RESET PASSWORD
-----------------------------------
*/

if(isset($_POST['reset'])){

    $username = $_POST['username'];

    $new_password = $_POST['new_password'];

    $confirm_password = $_POST['confirm_password'];


    /*
    -----------------------------------
    PASSWORD MATCH CHECK
    -----------------------------------
    */

    if($new_password != $confirm_password){

        echo "

        <script>

            alert('Passwords Do Not Match');

        </script>

        ";

    }
    else{


        /*
        -----------------------------------
        CHECK USERNAME EXISTS
        -----------------------------------
        */

        $check = mysqli_query(
            $conn,
            "SELECT * FROM emp_details
             WHERE username='$username'"
        );


        if(mysqli_num_rows($check) > 0){


            /*
            -----------------------------------
            ENCRYPT PASSWORD
            -----------------------------------
            */

            $encrypted_password = password_hash(
                $new_password,
                PASSWORD_DEFAULT
            );


            /*
            -----------------------------------
            UPDATE PASSWORD
            -----------------------------------
            */

            mysqli_query(

                $conn,

                "UPDATE emp_details

                 SET password='$encrypted_password'

                 WHERE username='$username'"

            );


            echo "

            <script>

                alert('Password Updated Successfully');

                window.location='login.php';

            </script>

            ";

        }
        else{

            echo "

            <script>

                alert('Username Not Found');

            </script>

            ";

        }

    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    height:100vh;

    overflow:hidden;

}


/*
-----------------------------------
SLIDESHOW
-----------------------------------
*/

/*
-----------------------------------
SLIDESHOW
-----------------------------------
*/

.slideshow{

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    z-index:-2;

    background:black;

    overflow:hidden;

}

.slideshow img{

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:100%;

    object-fit:cover;

    opacity:0;

    animation:smoothFade 18s infinite;

    backface-visibility:hidden;

    will-change:opacity, transform;

}


/*
-----------------------------------
DELAYS
-----------------------------------
*/

.slideshow img:nth-child(1){

    animation-delay:0s;

}

.slideshow img:nth-child(2){

    animation-delay:6s;

}

.slideshow img:nth-child(3){

    animation-delay:12s;

}


/*
-----------------------------------
SMOOTH TRANSITION
-----------------------------------
*/

@keyframes smoothFade{

    0%{
        opacity:0;
        transform:scale(1);
    }

    5%{
        opacity:1;
    }

    30%{
        opacity:1;
        transform:scale(1.04);
    }

    35%{
        opacity:0;
    }

    100%{
        opacity:0;
        transform:scale(1);
    }

}


/*
-----------------------------------
OVERLAY
-----------------------------------
*/

.overlay{

    width:100%;
    height:100vh;

    background:rgba(0,0,0,0.65);

    display:flex;

    justify-content:center;

    align-items:center;

}


/*
-----------------------------------
FORM BOX
-----------------------------------
*/

.reset-box{

    width:430px;

    background:rgba(255,255,255,0.08);

    backdrop-filter:blur(6px);

    -webkit-backdrop-filter:blur(6px);

    border:1px solid rgba(255,255,255,0.15);

    padding:40px;

    border-radius:18px;

    box-shadow:0 0 25px rgba(0,0,0,0.4);

}

.reset-box h2{

    text-align:center;

    margin-bottom:30px;

    font-size:36px;

    color:white;

}


/*
-----------------------------------
INPUTS
-----------------------------------
*/

.input-box{

    margin-bottom:22px;

}

.input-box label{

    display:block;

    margin-bottom:10px;

    color:white;

    font-size:17px;

    font-weight:bold;

}

.input-box input{

    width:100%;

    padding:14px;

    border:1px solid rgba(255,255,255,0.25);

    border-radius:10px;

    font-size:16px;

    background:rgba(255,255,255,0.10);

    color:white;

}


/*
-----------------------------------
BUTTON
-----------------------------------
*/

.reset-btn{

    width:100%;

    padding:15px;

    background:#007bff;

    color:white;

    border:none;

    border-radius:10px;

    font-size:20px;

    cursor:pointer;

}


/*
-----------------------------------
LINK
-----------------------------------
*/

.back-link{

    text-align:center;

    margin-top:22px;

}

.back-link a{

    color:#00aaff;

    text-decoration:none;

    font-size:18px;

    font-weight:bold;

}

</style>

</head>

<body>


<!-- SLIDESHOW -->


<div class="slideshow">

    <img src="slide1.jpg">

    <img src="slide2.jpg">

    <img src="slide3.jpg">

</div>



<!-- OVERLAY -->


<div class="overlay">


    <div class="reset-box">

        <h2>Reset Password</h2>

        <form method="POST">

            <div class="input-box">

                <label>Username</label>

                <input type="text"
                       name="username"
                       required>

            </div>


            <div class="input-box">

                <label>New Password</label>

                <input type="password"
                       name="new_password"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Confirm Password</label>

                <input type="password"
                       name="confirm_password"
                        autocomplete="off"
                       required>

            </div>


            <button type="submit"
                    name="reset"
                    class="reset-btn">

                Reset Password

            </button>

        </form>


        <div class="back-link">

            <a href="login.php">

                Back To Login

            </a>

        </div>

    </div>

</div>

</body>
</html>