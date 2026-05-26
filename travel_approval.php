<?php

session_start();

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "wil_company"
);


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
/*
-----------------------------------
SEARCH
-----------------------------------
*/

if(isset($_POST['search'])){

    $search = $_POST['search_code'];

    $result = mysqli_query(

        $conn,

        "SELECT *
         FROM travel_requests

         WHERE

         request_code LIKE '%$search%'

         OR employee_name LIKE '%$search%'

         OR employee_id LIKE '%$search%'

         OR department LIKE '%$search%'

         OR travel_from LIKE '%$search%'

         OR travel_to LIKE '%$search%'

         OR status LIKE '%$search%'

         ORDER BY id DESC"

    );

}
else{

    $result = mysqli_query(

        $conn,

        "SELECT *
         FROM travel_requests
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
     FROM travel_requests"

);

$total_row = mysqli_fetch_assoc(
    $total_query
);

$total_records = $total_row['total'];

$total_pages = ceil(
    $total_records / $limit
);


/*
-----------------------------------
APPROVE
-----------------------------------
*/

if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    mysqli_query(

        $conn,

        "UPDATE travel_requests

         SET status='Approved'

         WHERE id='$id'"

    );

}


/*
-----------------------------------
REJECT
-----------------------------------
*/

if(isset($_POST['reject_submit'])){

    $id = $_POST['reject_id'];

    $reason = $_POST['reject_reason'];

    mysqli_query(

        $conn,

        "UPDATE travel_requests

         SET

         status='Rejected',
         reject_reason='$reason'

         WHERE id='$id'"

    );

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Travel Approval</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f2f2f2;
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

    font-size:30px;

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
TABLE BOX
-----------------------------------
*/

.table-box{

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:30px;

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

    width:300px;

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

    color:white;

}

table th,
table td{

    border:1px solid rgba(255,255,255,0.2);

    padding:12px;

    text-align:center;

}

table th{

    background:rgba(0,0,0,0.35);

}


/*
-----------------------------------
BUTTONS
-----------------------------------
*/

.approve{

    background:#28a745;

    color:white;

    padding:8px 14px;

    border-radius:6px;

    text-decoration:none;

}

.reject{

    background:#dc3545;

    color:white;

    padding:8px 14px;

    border:none;

    border-radius:6px;

    cursor:pointer;

}


/*
-----------------------------------
REJECT POPUP
-----------------------------------
*/

.popup{

    display:none;

    position:fixed;

    top:50%;

    left:50%;

    transform:translate(-50%,-50%);

    background:white;

    padding:30px;

    border-radius:15px;

    width:400px;

    z-index:999;

}

.popup textarea{

    width:100%;

    height:120px;

    padding:10px;

    margin-top:15px;

}

.popup button{

    margin-top:20px;

    padding:10px 18px;

    border:none;

    background:#dc3545;

    color:white;

    border-radius:8px;

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


<a href="logout.php"
   class="logout-btn">

Logout

</a>


<div class="topbar">

WHEELS INDIA LIMITED

</div>


<div class="main">


<div class="table-box">

<h2 style="color:white; margin-bottom:25px;">

TRAVEL REQUEST APPROVAL

</h2>


<div class="search-box">

<form method="POST">

<input type="text"
       name="search_code"
       autocomplete="off"
       placeholder=""
       required>

<button type="submit"
        name="search">

Search

</button>

</form>

</div>


<table>

<tr>

<th>Request Code</th>

<th>Employee</th>

<th>Department</th>

<th>Travel</th>

<th>Date</th>

<th>Amount</th>

<th>Status</th>

<th>Action</th>

</tr>


<?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td>

<?php echo $row['request_code']; ?>

</td>


<td>

<?php echo $row['employee_name']; ?>

</td>


<td>

<?php echo $row['department']; ?>

</td>


<td>

<?php echo $row['travel_from']; ?>

→

<?php echo $row['travel_to']; ?>

</td>


<td>

<?php echo $row['travel_date']; ?>

</td>


<td>

₹ <?php echo $row['advance_amount']; ?>

</td>


<td>

<?php echo $row['status']; ?>

</td>


<td>

<a href="travel_approval.php?approve=<?php echo $row['id']; ?>"
   class="approve"
   onclick="return confirm('Confirm To Approve This Request?')">

Approve

</a>

<br><br>

<button class="reject"
        onclick="showRejectBox(<?php echo $row['id']; ?>)">

Reject

</button>

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

<a href="travel_approval.php?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

<?php

}

?>

</div>


</div>

</div>


<!-- REJECT POPUP -->


<div class="popup"
     id="rejectPopup">

<form method="POST">

<input type="hidden"
       name="reject_id"
       id="reject_id">

<h2>

Reject Reason

</h2>

<textarea name="reject_reason"
 autocomplete="off"
          required></textarea>

<br>

<button type="submit"
        name="reject_submit">

Submit Reject

</button>

</form>

</div>


<script>

function showRejectBox(id){

    document.getElementById(
        "rejectPopup"
    ).style.display = "block";

    document.getElementById(
        "reject_id"
    ).value = id;

}

</script>

</body>
</html>