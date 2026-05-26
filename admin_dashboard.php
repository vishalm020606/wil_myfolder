<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

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

    background:rgba(0,0,0,0.70);

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.title{

    color:white;

    font-size:52px;

    font-weight:bold;

    margin-bottom:70px;

}


/*
-----------------------------------
LOGO CONTAINER
-----------------------------------
*/

.logo-container{

    display:flex;

    gap:50px;

}


/*
-----------------------------------
LOGO CARD
-----------------------------------
*/

.logo-card{

    width:230px;

    height:230px;

    background:rgba(255,255,255,0.10);

    backdrop-filter:blur(6px);

    border:1px solid rgba(255,255,255,0.15);

    border-radius:20px;

    display:flex;

    justify-content:center;

    align-items:center;

    transition:0.3s;

    cursor:pointer;

}

.logo-card:hover{

    transform:scale(1.05);

    background:rgba(255,255,255,0.18);

}

.logo-card img{

    width:140px;

}


/*
-----------------------------------
TEXT
-----------------------------------
*/

.card-title{

    color:white;

    text-align:center;

    margin-top:18px;

    font-size:22px;

    font-weight:bold;

}
/*
-----------------------------------
LOGOUT BUTTON
-----------------------------------
*/

.logout-btn{

    position:fixed;

    top:20px;

    right:25px;

    background:#dc3545;

    color:white;

    padding:12px 22px;

    border-radius:10px;

    text-decoration:none;

    font-size:18px;

    font-weight:bold;

    z-index:999;

    transition:0.3s;

    box-shadow:0 0 10px rgba(0,0,0,0.3);

}

.logout-btn:hover{

    background:#b02a37;

    transform:scale(1.05);

}
</style>

</head>

<body>
    <a href="logout.php"
   class="logout-btn">

   Logout

</a>


<div class="slideshow">

    <img src="slide1.jpg">

    <img src="slide2.jpg">

    <img src="slide3.jpg">

</div>



<div class="overlay">

    <div class="title">

        Admin Control Dashboard

    </div>


    <div class="logo-container">


        <div>

            <a href="travel_approval.php">

                <div class="logo-card">

                    <img src="logo1.png">

                </div>

            </a>

            <div class="card-title">

                Travel Requests

            </div>

        </div>


<div class="dashboard-card">

    <div class="logo-card"
         onclick="window.location.href='home.php'">

        <img src="logo2.png">

    </div>

    <div class="card-title">

        Edit & Update

    </div>

</div>

            </a>

            <div class="card-title">

                

            </div>

        </div>



        <div>

            <a href="#">

                <div class="logo-card">

                    <img src="logo3.png">

                </div>

            </a>

            <div class="card-title">

                Hospitality Report

            </div>
            <div>

        </div>


    </div>

</div>

</body>
</html>