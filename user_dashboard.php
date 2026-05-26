<?php

session_start();

if(!isset($_SESSION['username'])){

    header("Location: login.php");

    exit();

}

?>


<!DOCTYPE html>
<html>

<head>

<title>User Dashboard</title>

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
BACKGROUND
-----------------------------------
*/

body::before{

    content:"";

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:url('slide1.jpg');

    background-size:cover;

    background-position:center;

    z-index:-2;

}


/*
-----------------------------------
OVERLAY
-----------------------------------
*/

.overlay{

    width:100%;
    height:100vh;

    background:rgba(0,0,0,0.60);

    display:flex;

    flex-direction:column;

    align-items:center;

}


/*
-----------------------------------
LOGOUT BUTTON
-----------------------------------
*/

.logout-btn{

    position:absolute;

    top:25px;

    right:30px;

    background:#dc3545;

    color:white;

    padding:14px 28px;

    border-radius:12px;

    text-decoration:none;

    font-size:20px;

    font-weight:bold;

    transition:0.3s;

}

.logout-btn:hover{

    background:#b02a37;

    transform:scale(1.05);

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.title{

    margin-top:180px;

    color:white;

    font-size:72px;

    font-weight:bold;

    text-align:center;

}


/*
-----------------------------------
CARD CONTAINER
-----------------------------------
*/

.card-container{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:70px;

    margin-top:90px;

}


/*
-----------------------------------
DASHBOARD CARD
-----------------------------------
*/

.dashboard-card{

    display:flex;

    flex-direction:column;

    align-items:center;

}


/*
-----------------------------------
LOGO CARD
-----------------------------------
*/

.logo-card{

    width:280px;

    height:280px;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:24px;

    border:1px solid rgba(255,255,255,0.18);

    display:flex;

    justify-content:center;

    align-items:center;

    cursor:pointer;

    transition:0.3s;

}


.logo-card:hover{

    transform:scale(1.05);

    background:rgba(255,255,255,0.18);

}


/*
-----------------------------------
IMAGES
-----------------------------------
*/

.logo-card img{

    width:150px;

}


/*
-----------------------------------
TEXT
-----------------------------------
*/

.logo-text{

    color:white;

    margin-top:24px;

    font-size:30px;

    font-weight:bold;

    text-align:center;

}

</style>

</head>

<body>


<div class="overlay">


<a href="logout.php"
   class="logout-btn">

   Logout

</a>



<div class="title">

   

</div>



<div class="card-container">


    <!-- TRAVEL MANAGEMENT -->

    <div class="dashboard-card">

        <div class="logo-card"
             onclick="window.location.href='travel_request.php'">

            <img src="logo2.png">

        </div>

        <div class="logo-text">

            Travel Request

        </div>

    </div>



    <!-- REQUEST STATUS -->

    <div class="dashboard-card">

        <div class="logo-card"
             onclick="window.location.href='travel_status.php'">

            <img src="logo4.png">

        </div>

        <div class="logo-text">

            Request Status

        </div>

    </div>


</div>

</div>

</body>
</html>