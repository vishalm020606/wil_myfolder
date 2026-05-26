<?php

session_start();

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "wil_company"
);


$username = $_SESSION['username'];


/*
-----------------------------------
FETCH LATEST REQUEST
-----------------------------------
*/

$result = mysqli_query(

    $conn,

    "SELECT *
     FROM travel_requests
     WHERE username='$username'
     ORDER BY id DESC
     LIMIT 1"

);


$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html>

<head>

<title>Travel Request Report</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:#f2f2f2;

}


/*
-----------------------------------
CARD
-----------------------------------
*/

.report-card{

    width:750px;

    background:white;

    border-radius:18px;

    padding:40px;

    box-shadow:0 0 25px rgba(0,0,0,0.2);

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.title{

    text-align:center;

    font-size:34px;

    font-weight:bold;

    color:#007bff;

    margin-bottom:35px;

}


/*
-----------------------------------
ROWS
-----------------------------------
*/

.row{

    display:flex;

    margin-bottom:18px;

    border-bottom:1px solid #ddd;

    padding-bottom:12px;

}


.label{

    width:250px;

    font-weight:bold;

    color:#333;

    font-size:18px;

}


.value{

    flex:1;

    color:#555;

    font-size:18px;

}


/*
-----------------------------------
STATUS
-----------------------------------
*/

.status{

    color:green;

    font-weight:bold;

}


/*
-----------------------------------
BUTTONS
-----------------------------------
*/

.btn-area{

    margin-top:35px;

    text-align:center;

}


.btn{

    background:#007bff;

    color:white;

    padding:14px 28px;

    border:none;

    border-radius:10px;

    font-size:18px;

    cursor:pointer;

    text-decoration:none;

    margin:0 10px;

}


.print-btn{

    background:#28a745;

}

</style>

</head>

<body>


<div class="report-card">


<div class="title">

    TRAVEL REQUEST REPORT

</div>



<div class="row">

    <div class="label">

        Employee Name

    </div>

    <div class="value">

        <?php echo $row['employee_name']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Employee ID

    </div>

    <div class="value">

        <?php echo $row['employee_id']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Department

    </div>

    <div class="value">

        <?php echo $row['department']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Travel Route

    </div>

    <div class="value">

        <?php echo $row['travel_from']; ?>

        →

        <?php echo $row['travel_to']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Travel Date

    </div>

    <div class="value">

        <?php echo $row['travel_date']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Travel Time

    </div>

    <div class="value">

        <?php echo $row['travel_time']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Mode Of Travel

    </div>

    <div class="value">

        <?php echo $row['mode_of_travel']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Number Of Persons

    </div>

    <div class="value">

        <?php echo $row['no_of_persons']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Purpose

    </div>

    <div class="value">

        <?php echo $row['purpose']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Advance Amount

    </div>

    <div class="value">

        ₹ <?php echo $row['advance_amount']; ?>

    </div>

</div>



<div class="row">

    <div class="label">

        Approval Status

    </div>

    <div class="value status">

        <?php echo $row['status']; ?>

    </div>

</div>



<div class="btn-area">

<button class="btn print-btn"
        onclick="window.print()">

    Print / Download

</button>


<a href="travel_request.php"
   class="btn">

   Back

</a>

</div>

</div>

</body>
</html>