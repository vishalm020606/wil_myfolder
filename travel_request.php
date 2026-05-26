<?php

session_start();

if(!isset($_SESSION['username'])){

    header("Location: login.php");

    exit();

}


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
SAVE REQUEST
-----------------------------------
*/

$success = "";

if(isset($_POST['submit'])){
    $request_code = "PADI_" . rand(100,999);

    $username = $_SESSION['username'];

    $employee_name = $_POST['employee_name'];

    $employee_id = $_POST['employee_id'];

    $department = $_POST['department'];

    $travel_from = $_POST['travel_from'];

    $travel_to = $_POST['travel_to'];

    $travel_date = $_POST['travel_date'];

    $travel_time = $_POST['travel_time'];

    $mode = $_POST['mode'];

    $persons = $_POST['persons'];

    $purpose = $_POST['purpose'];

    $amount = $_POST['amount'];


    $insert = mysqli_query(

        $conn,

        "INSERT INTO travel_requests(

            request_code,
            username,
            employee_name,
            employee_id,
            department,
            travel_from,
            travel_to,
            travel_date,
            travel_time,
            mode_of_travel,
            no_of_persons,
            purpose,
            advance_amount,
            status

        )

        VALUES(

            '$request_code',
            '$username',
            '$employee_name',
            '$employee_id',
            '$department',
            '$travel_from',
            '$travel_to',
            '$travel_date',
            '$travel_time',
            '$mode',
            '$persons',
            '$purpose',
            '$amount',
            'Pending'

        )"

    );


    if($insert){

        $success = "

        <div class='success-box'>

            Travel Request Submitted Successfully
            <br><br>

Your Request Code:

<b>$request_code</b>

        </div>

        ";

    }

}


/*
-----------------------------------
CHECK STATUS
-----------------------------------
*/

$status_message = "";

if(isset($_GET['status'])){

    $username = $_SESSION['username'];

    $status_query = mysqli_query(

        $conn,

        "SELECT status
         FROM travel_requests
         WHERE username='$username'
         ORDER BY id DESC
         LIMIT 1"

    );

    if(mysqli_num_rows($status_query)>0){

        $status_row = mysqli_fetch_assoc($status_query);

        $status = $status_row['status'];


        if($status == "Approved"){

            $status_message = "

            <div class='approved-box'>

                Your Travel Request Is Approved

            </div>

            ";

        }
        else if($status == "Rejected"){

            $status_message = "

            <div class='rejected-box'>

                Your Travel Request Is Rejected

            </div>

            ";

        }
        else{

            $status_message = "

            <div class='pending-box'>

                Your Travel Request Is Pending

            </div>

            ";

        }

    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Travel Request</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    min-height:100vh;

    overflow:auto;

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

    min-height:100vh;

    background:rgba(0,0,0,0.65);

    padding-bottom:50px;

}


/*
-----------------------------------
TOPBAR
-----------------------------------
*/

.topbar{

    width:100%;

    height:70px;

    background:rgba(0,0,0,0.45);

    backdrop-filter:blur(6px);

    color:white;

    display:flex;

    align-items:center;

    padding-left:30px;

    font-size:30px;

    font-weight:bold;

}


/*
-----------------------------------
MAIN
-----------------------------------
*/

.main{

    display:flex;

    justify-content:center;

    align-items:center;

    padding:40px;

}


/*
-----------------------------------
FORM BOX
-----------------------------------
*/

.form-box{

    width:1100px;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,0.18);

    padding:40px;

    border-radius:20px;

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.form-box h2{

    text-align:center;

    margin-bottom:35px;

    color:white;

    font-size:38px;

}


/*
-----------------------------------
GRID
-----------------------------------
*/

.grid{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:25px;

}


/*
-----------------------------------
INPUT BOX
-----------------------------------
*/

.input-box label{

    display:block;

    margin-bottom:10px;

    color:white;

    font-weight:bold;

}

.input-box input,
.input-box select{

    width:100%;

    padding:14px;

    border-radius:10px;

    border:none;

    font-size:16px;

}


/*
-----------------------------------
BUTTONS
-----------------------------------
*/

.btn{

    margin-top:30px;

    padding:14px 28px;

    border:none;

    border-radius:10px;

    font-size:18px;

    color:white;

    cursor:pointer;

}

.submit-btn{

    background:#007bff;

}

.download-btn{

    background:#28a745;

    text-decoration:none;

    margin-left:10px;

}

.status-btn{

    background:#ffc107;

    color:black;

    padding:14px 22px;

    border-radius:10px;

    text-decoration:none;

    margin-left:10px;

    font-weight:bold;

}


/*
-----------------------------------
SUCCESS & STATUS BOXES
-----------------------------------
*/

.success-box,
.approved-box,
.rejected-box,
.pending-box{

    margin-top:30px;

    padding:18px;

    border-radius:10px;

    text-align:center;

    font-size:22px;

    font-weight:bold;

}

.success-box{

    background:#d4edda;

    color:#155724;

}

.approved-box{

    background:#d4edda;

    color:#155724;

}

.rejected-box{

    background:#f8d7da;

    color:#721c24;

}

.pending-box{

    background:#fff3cd;

    color:#856404;

}


/*
-----------------------------------
LOGOUT
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

}

.logout-btn:hover{

    background:#b02a37;

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


<div class="topbar">

    WHEELS INDIA LIMITED

</div>



<a href="logout.php"
   class="logout-btn">

   Logout

</a>



<div class="main">

<div class="form-box">

<h2>

TRAVEL ADVANCE REQUEST

</h2>


<form method="POST">


<div class="grid">


<div class="input-box">

<label>Employee Name</label>

<input type="text"
       name="employee_name"
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

<label>Department</label>

<input type="text"
       name="department"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Travel Date</label>

<input type="date"
       name="travel_date"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Travel From</label>

<input type="text"
       name="travel_from"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Travel To</label>

<input type="text"
       name="travel_to"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Travel Time</label>

<input type="time"
       name="travel_time"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Mode Of Travel</label>

<select name="mode">

<option>Bus</option>

<option>Train</option>

<option>Flight</option>

<option>Cab</option>

</select>

</div>



<div class="input-box">

<label>No Of Persons</label>

<input type="number"
       name="persons"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Purpose Of Visit</label>

<input type="text"
       name="purpose"
        autocomplete="off"
       required>

</div>



<div class="input-box">

<label>Advance Amount</label>

<input type="number"
       name="amount"
       id="amount"
       onkeyup="showWords()"
       autocomplete="off"
       required>

<div id="amountWords"
     style="margin-top:10px;
            color:#00ff99;
            font-weight:bold;">

</div>

</div>

</div>


<button type="submit"
        name="submit"
        class="btn submit-btn">

    Send Request

</button>



<a href="travel_report.php">

<button type="button"
        class="btn download-btn">

    Download Report

</button>

</a>


<?php echo $success; ?>

<?php echo $status_message; ?>


</form>

</div>

</div>

</div>


<script>

function convertNumberToWords(amount){

    const words = [

        '', 'One', 'Two', 'Three',
        'Four', 'Five', 'Six',
        'Seven', 'Eight', 'Nine',
        'Ten', 'Eleven', 'Twelve',
        'Thirteen', 'Fourteen',
        'Fifteen', 'Sixteen',
        'Seventeen', 'Eighteen',
        'Nineteen', 'Twenty',
        'Thirty', 'Forty',
        'Fifty', 'Sixty',
        'Seventy', 'Eighty',
        'Ninety'

    ];

    function convert(n){

        if(n < 20){

            return words[n];

        }

        else if(n < 100){

            return words[
                18 + Math.floor(n / 10)
            ] + " " + words[n % 10];

        }

        else if(n < 1000){

            return words[
                Math.floor(n / 100)
            ] + " Hundred " +
            convert(n % 100);

        }

        else if(n < 100000){

            return convert(
                Math.floor(n / 1000)
            ) + " Thousand " +
            convert(n % 1000);

        }

        else{

            return n;

        }

    }

    return convert(amount) + " Rupees";

}


function showWords(){

    let amount = document.getElementById(
        "amount"
    ).value;

    if(amount != ""){

        document.getElementById(
            "amountWords"
        ).innerHTML =
        convertNumberToWords(amount);

    }

}

</script>

</body>
</html>