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
    "wil_company"
);

if(!$conn){

    die("Database Connection Failed");

}


/*
-----------------------------------
LOGIN PROCESS
-----------------------------------
*/

if(isset($_POST['login'])){

    $username = $_POST['username'];

    $password = $_POST['password'];


    /*
    -----------------------------------
    CHECK USERNAME
    -----------------------------------
    */

    $sql = "SELECT * FROM emp_details
            WHERE username='$username'";

    $result = mysqli_query($conn,$sql);


    /*
    -----------------------------------
    USER FOUND
    -----------------------------------
    */

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);


        /*
        -----------------------------------
        VERIFY ENCRYPTED PASSWORD
        -----------------------------------
        */

        if(password_verify(
            $password,
            $row['password']
        )){


            /*
            -----------------------------------
            CREATE SESSION
            -----------------------------------
            */

            $_SESSION['username']
                = $row['username'];

            $_SESSION['full_name']
                = $row['full_name'];


            /*
            -----------------------------------
            REDIRECT TO HOME PAGE
            -----------------------------------
            */

           header("Location: user_dashboard.php");

            exit();

        }
        else{

            echo "

            <script>

                alert('Invalid Password');

            </script>

            ";

        }

    }
    else{

        echo "

        <script>

            alert('Username Not Found');

        </script>

        ";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

    <title>Wheels India Employee Portal</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        body{

            height:100vh;

            background-image:url('wheel_bg.jpg');

            background-size:cover;

            background-position:center top;

            background-repeat:no-repeat;

            background-attachment:fixed;

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
.overlay{

    position:relative;

    z-index:1;

    width:100%;
    height:100vh;

    background:rgba(0,0,0,0.65);

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:60px 90px;

}

        
        .left-section{

            width:45%;

            color:white;

            margin-top:-120px;

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
.input-box input::placeholder{

    color:#dddddd;

}
 .input-box input{

    width:100%;

    padding:14px;

    border:1px solid rgba(255,255,255,0.25);

    border-radius:10px;

    font-size:17px;

    background:rgba(255,255,255,0.10);

    color:white;

    outline:none;

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

            transition:0.3s;

        }

        .login-btn:hover{

            background:#0056b3;

        }

        .links{

            margin-top:25px;

            text-align:center;

        }

        .links a{

            text-decoration:none;

            color:#007bff;

            font-size:18px;

            font-weight:bold;

        }

        .links a:hover{

            text-decoration:underline;

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

        <h2>Employee Login</h2>

        <form method="POST">

            <div class="input-box">

                <label>Username</label>

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
                    name="login"
                    class="login-btn">

                Login

            </button>

        </form>
       

        <div class="links">

    <p>

        <a href="register.php">

            New Registration

        </a>

    </p>

    <br>

    <p>

        <a href="forget_password.php">

            Forgot Password?

        </a>

    </p>

    <br>

    <p>

        <a href="admin_login.php">

            Admin Login

        </a>

    </p>

</div>

    </div>

</div>

</body>
</html>