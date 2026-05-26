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
PAGINATION
-----------------------------------
*/

$limit = 5;

$page = 1;

if(isset($_GET['page'])){

    $page = $_GET['page'];

}

$start = ($page - 1) * $limit;


/*
-----------------------------------
SEARCH
-----------------------------------
*/

if(isset($_POST['search'])){

    $search = $_POST['search'];

    $result = mysqli_query(

        $conn,

        "SELECT *
         FROM travel_requests

         WHERE username='$username'

         AND (

         request_code LIKE '%$search%'

         OR travel_from LIKE '%$search%'

         OR travel_to LIKE '%$search%'

         OR purpose LIKE '%$search%'

         OR status LIKE '%$search%'

         )

         ORDER BY id DESC"

    );

}
else{

    $result = mysqli_query(

        $conn,

        "SELECT *
         FROM travel_requests

         WHERE username='$username'

         ORDER BY id DESC

         LIMIT $start,$limit"

    );

}


/*
-----------------------------------
TOTAL PAGES
-----------------------------------
*/

$total_query = mysqli_query(

    $conn,

    "SELECT COUNT(*) AS total

     FROM travel_requests

     WHERE username='$username'"

);

$total_row = mysqli_fetch_assoc(
    $total_query
);

$total_records = $total_row['total'];

$total_pages = ceil(
    $total_records / $limit
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Travel Status</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    overflow-x:hidden;
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
TOPBAR
-----------------------------------
*/

.topbar{

    width:100%;
    height:70px;

    background:rgba(0,0,0,0.65);

    color:white;

    display:flex;

    align-items:center;

    padding-left:30px;

    font-size:32px;

    font-weight:bold;

}


/*
-----------------------------------
MAIN
-----------------------------------
*/

.main{

    padding:40px;

}


/*
-----------------------------------
BOX
-----------------------------------
*/

.table-box{

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:30px;

    color:white;

}


/*
-----------------------------------
SEARCH
-----------------------------------
*/

.search-box{

    margin-bottom:25px;

}

.search-box input{

    padding:12px;

    width:320px;

    border:none;

    border-radius:8px;

    font-size:16px;

}

.search-box button{

    padding:12px 18px;

    border:none;

    background:#007bff;

    color:white;

    border-radius:8px;

    cursor:pointer;

}


/*
-----------------------------------
TABLE
-----------------------------------
*/

table{

    width:100%;

    border-collapse:collapse;

}

table th,
table td{

    border:1px solid rgba(255,255,255,0.20);

    padding:14px;

    text-align:center;

}

table th{

    background:rgba(0,0,0,0.35);

}


/*
-----------------------------------
STATUS COLORS
-----------------------------------
*/

.approved{

    color:#00ff66;

    font-weight:bold;

}

.rejected{

    color:#ff4d4d;

    font-weight:bold;

}

.pending{

    color:#ffd633;

    font-weight:bold;

}


/*
-----------------------------------
BUTTON
-----------------------------------
*/

.back-btn{

    display:inline-block;

    margin-top:30px;

    padding:12px 22px;

    background:#007bff;

    color:white;

    text-decoration:none;

    border-radius:8px;

    font-weight:bold;

}


/*
-----------------------------------
PAGINATION
-----------------------------------
*/

.pagination{

    margin-top:25px;

    text-align:center;

}

.pagination a{

    display:inline-block;

    padding:10px 16px;

    margin:5px;

    background:#007bff;

    color:white;

    text-decoration:none;

    border-radius:8px;

    font-weight:bold;

}

.pagination a:hover{

    background:#0056b3;

}

</style>

</head>

<body>


<div class="slideshow">

<img src="slide1.jpg">
<img src="slide2.jpg">
<img src="slide3.jpg">

</div>


<div class="topbar">

WHEELS INDIA LIMITED

</div>


<div class="main">


<div class="table-box">


<h1 style="margin-bottom:25px;">

Travel Request Status

</h1>


<div class="search-box">

<form method="POST">

<input type="text"
       name="search"
       placeholder="Search Anything..."
       required>

<button type="submit"
        name="search_btn">

Search

</button>

</form>

</div>


<table>

<tr>

<th>Request Code</th>

<th>Travel From</th>

<th>Travel To</th>

<th>Date</th>

<th>Purpose</th>

<th>Amount</th>

<th>Status</th>

<th>Reject Reason</th>

</tr>


<?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td>

<?php echo $row['request_code']; ?>

</td>

<td>

<?php echo $row['travel_from']; ?>

</td>

<td>

<?php echo $row['travel_to']; ?>

</td>

<td>

<?php echo $row['travel_date']; ?>

</td>

<td>

<?php echo $row['purpose']; ?>

</td>

<td>

₹ <?php echo $row['advance_amount']; ?>

</td>

<td>

<?php

if($row['status']=="Approved"){

    echo "<span class='approved'>Approved</span>";

}
else if($row['status']=="Rejected"){

    echo "<span class='rejected'>Rejected</span>";

}
else{

    echo "<span class='pending'>Pending</span>";

}

?>

</td>

<td>

<?php

if($row['reject_reason']==""){

    echo "—";

}
else{

    echo $row['reject_reason'];

}

?>

</td>

</tr>

<?php

}

?>

</table>


<!-- PAGINATION -->

<div class="pagination">

<?php

for($i=1; $i<=$total_pages; $i++){

?>

<a href="travel_status.php?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

<?php

}

?>

</div>


<a href="user_dashboard.php"
   class="back-btn">

Back

</a>


</div>

</div>

</body>
</html>