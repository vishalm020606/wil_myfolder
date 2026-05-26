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
REGISTER USER
-----------------------------------
*/

if(isset($_POST['register'])){

    $full_name   = $_POST['full_name'];

    $dob         = $_POST['dob'];

    $gender      = $_POST['gender'];

    $email       = $_POST['email'];

    $phone       = $_POST['phone'];

    $department  = $_POST['department'];

    $employee_id = $_POST['employee_id'];

    $username    = $_POST['username'];


    /*
    -----------------------------------
    ENCRYPT PASSWORD
    -----------------------------------
    */

    $password = password_hash(
                    $_POST['password'],
                    PASSWORD_DEFAULT
                );


    /*
    -----------------------------------
    CHECK DUPLICATE EMPLOYEE ID
    -----------------------------------
    */

    $check = mysqli_query(
        $conn,
        "SELECT * FROM emp_details
         WHERE employee_id='$employee_id'"
    );

    if(mysqli_num_rows($check) > 0){

        echo "

        <script>

            alert('Employee ID Already Exists');

            window.location='register.php';

        </script>

        ";

        exit();

    }


    /*
    -----------------------------------
    INSERT DATA
    -----------------------------------
    */

    $sql = "INSERT INTO emp_details
    (
        full_name,
        dob,
        gender,
        email,
        phone,
        department,
        employee_id,
        username,
        password
    )

    VALUES

    (
        '$full_name',
        '$dob',
        '$gender',
        '$email',
        '$phone',
        '$department',
        '$employee_id',
        '$username',
        '$password'
    )";


    if(mysqli_query($conn,$sql)){

        echo "

        <script>

            alert('Registration Successful');

            window.location='login.php';

        </script>

        ";

    }
    else{

        echo "

        <script>

            alert('Registration Failed');

        </script>

        ";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Wheels India Registration</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}


/*
-----------------------------------
BODY
-----------------------------------
*/

body{

    height:100vh;

    overflow:hidden;

}


/*
-----------------------------------
SLIDES/*
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

    position:relative;

    z-index:1;

    width:100%;
    height:100vh;

    background:rgba(0,0,0,0.65);

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:50px 90px;

}
/*
-----------------------------------
LEFT CONTENT
-----------------------------------
*/

.left-section{

    width:42%;

    color:white;

    margin-top:-80px;

}

.company-name{

    color:#00aaff;

    font-size:46px;

    font-weight:bold;

    margin-bottom:25px;

}

.main-title{

    font-size:54px;

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
REGISTER BOX
-----------------------------------
*/

.register-box{

    width:500px;

    background:rgba(255,255,255,0.08);

    backdrop-filter:blur(6px);

    -webkit-backdrop-filter:blur(6px);

    border:1px solid rgba(255,255,255,0.15);

    padding:35px;

    border-radius:18px;

    box-shadow:0 0 25px rgba(0,0,0,0.4);

    max-height:92vh;

    overflow-y:auto;

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.register-box h2{

    text-align:center;

    margin-bottom:25px;

    color:white;

    font-size:36px;

}


/*
-----------------------------------
INPUTS
-----------------------------------
*/

.input-box{

    margin-bottom:16px;

}

.input-box label{

    display:block;

    margin-bottom:8px;

    font-size:16px;

    font-weight:bold;

    color:white;

}

.input-box input,
.input-box select{

    width:100%;

    padding:12px;

    border:1px solid rgba(255,255,255,0.25);

    border-radius:8px;

    font-size:15px;

    background:rgba(255,255,255,0.10);

    color:white;

    outline:none;

}

input::placeholder{

    color:#eeeeee;

}

select option{

    color:black;

}


/*
-----------------------------------
BUTTON
-----------------------------------
*/

.register-btn{

    width:100%;

    padding:14px;

    background:#007bff;

    color:white;

    border:none;

    border-radius:8px;

    font-size:18px;

    cursor:pointer;

    transition:0.3s;

}

.register-btn:hover{

    background:#0056b3;

}


/*
-----------------------------------
LOGIN LINK
-----------------------------------
*/

.login-link{

    text-align:center;

    margin-top:20px;

}

.login-link a{

    text-decoration:none;

    color:#00aaff;

    font-weight:bold;

    font-size:18px;

}

.login-link a:hover{

    text-decoration:underline;

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


    <!-- LEFT SECTION -->


    <div class="left-section">


    </div>



    <!-- REGISTER FORM -->


    <div class="register-box">

        <h2>New Registration</h2>

        <form method="POST">

            <div class="input-box">

                <label>Full Name</label>

                <input type="text"
                       name="full_name"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Date of Birth</label>

                <input type="date"
                       name="dob"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Gender</label>

                <select name="gender">

                    <option>Male</option>

                    <option>Female</option>

                </select>

            </div>


            <div class="input-box">

                <label>Email</label>

                <input type="email"
                       name="email"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Phone Number</label>

                <input type="text"
                       name="phone"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Department</label>

                <input type="text"
                       name="department"
                        autocomplete="off"
                       required>

            </div>


            <div class="input-box">

                <label>Employee ID</label>

                <input type="text"
                       name="employee_id"
                        autocomplete="off"
                       required>

            </div>


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
                    name="register"
                     autocomplete="off"
                    class="register-btn">

                Register

            </button>

        </form>


        <div class="login-link">

            <a href="login.php">

                Back To Login

            </a>

        </div>

    </div>

</div>

</body>
</html>