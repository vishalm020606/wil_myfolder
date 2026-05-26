<?php

session_start();

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
    "wil_admin"
);


if(!$conn){

    die("Database Connection Failed");

}


/*
-----------------------------------
ADMIN LOGIN
-----------------------------------
*/

if(isset($_POST['admin_login'])){

    $username = trim($_POST['username']);

    $password = trim($_POST['password']);


    $sql = "SELECT * FROM admin_details
            WHERE username='$username'
            AND password='$password'";


    $result = mysqli_query($conn,$sql);


    if(mysqli_num_rows($result) == 1){


        /*
        -----------------------------------
        CREATE SESSION
        -----------------------------------
        */

        $_SESSION['admin'] = $username;


        /*
        -----------------------------------
        REDIRECT
        -----------------------------------
        */

        header("Location: admin_dashboard.php");

        exit();

    }
    else{

        echo "

        <script>

            alert('Invalid Username or Password');

        </script>

        ";

    }

}

?>
<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>

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

    justify-content:space-between;

    align-items:center;

    padding:60px 90px;

}


/*
-----------------------------------
LEFT SECTION
-----------------------------------
*/

.left-section{

    width:45%;

    color:white;

    margin-top:-100px;

}

.company-name{

    color:#00aaff;

    font-size:48px;

    font-weight:bold;

    margin-bottom:25px;

}

.main-title{

    font-size:56px;

    font-weight:bold;

    line-height:1.15;

    margin-bottom:25px;

}

.subtitle{

    font-size:20px;

    color:#dddddd;

}


/*
-----------------------------------
ADMIN LOGIN BOX
-----------------------------------
*/

.login-box{

    width:400px;

    background:rgba(255,255,255,0.08);

    backdrop-filter:blur(6px);

    -webkit-backdrop-filter:blur(6px);

    border:1px solid rgba(255,255,255,0.15);

    padding:40px;

    border-radius:18px;

    box-shadow:0 0 25px rgba(0,0,0,0.4);

}

.login-box h2{

    text-align:center;

    margin-bottom:35px;

    font-size:38px;

    color:white;

}

.input-box{

    margin-bottom:25px;

}

.input-box label{

    display:block;

    margin-bottom:10px;

    font-size:18px;

    font-weight:bold;

    color:white;

}

.input-box input{

    width:100%;

    padding:14px;

    border:1px solid rgba(255,255,255,0.25);

    border-radius:10px;

    font-size:17px;

    background:rgba(255,255,255,0.10);

    color:white;

}

.login-btn{

    width:100%;

    padding:15px;

    background:#007bff;

    color:white;

    border:none;

    border-radius:10px;

    font-size:20px;

    cursor:pointer;

}

.links{

    margin-top:25px;

    text-align:center;

}

.links a{

    text-decoration:none;

    color:#00aaff;

    font-size:18px;

    font-weight:bold;

}

</style>

</head>

<body>


<div class="slideshow">

    <img src="slide1.jpg">

    <img src="slide2.jpg">

    <img src="slide3.jpg">

</div>



<div class="overlay">


    <div class="left-section">



    </div>



    <div class="login-box">

        <h2>Admin Login</h2>

        <form method="POST">

            <div class="input-box">

                <label> Username</label>

                <input type="text"
                       name="username"
                       autocomplete="off"
                       required>

            </div>

            <div class="input-box">

                <label>Password</label>

                <input type="password"
                       name="password"
                       autocomplete="off"
                       required>

            </div>

            <button type="submit"
                    name="admin_login"
                    class="login-btn">

                Login

            </button>

        </form>


        <div class="links">

            <a href="login.php">

                User Login

            </a>

        </div>

    </div>

</div>

</body>
</html>