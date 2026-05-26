<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors',1);


/*
-----------------------------------
CHECK LOGIN
-----------------------------------
*/

if(
    !isset($_SESSION['admin'])
    &&
    !isset($_SESSION['username'])
){

    die("Access Denied");

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
/*
-----------------------------------
FETCH EMPLOYEE DATA
-----------------------------------
*/

$result = mysqli_query(

    $conn,

    "SELECT * FROM emp_details"

);


if(!$result){

    die("Query Failed");

}

if(!$conn){

    die("Database Connection Failed");

}

?>
<!DOCTYPE html>
<html>

<head>

<title>Employee Management</title>

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

.slideshow{

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    z-index:-2;

}

.slideshow img{

    position:absolute;

    width:100%;
    height:100%;

    object-fit:cover;

    opacity:0;

    animation:fade 15s infinite;

}

.slideshow img:nth-child(1){

    animation-delay:0s;

}

.slideshow img:nth-child(2){

    animation-delay:5s;

}

.slideshow img:nth-child(3){

    animation-delay:10s;

}

@keyframes fade{

    0%{
        opacity:0;
    }

    10%{
        opacity:1;
    }

    30%{
        opacity:1;
    }

    40%{
        opacity:0;
    }

    100%{
        opacity:0;
    }

}


/*
-----------------------------------
OVERLAY
-----------------------------------
*/

.overlay{

    min-height:100vh;

    background:rgba(0,0,0,0.70);

    padding:40px;

}


/*
-----------------------------------
TITLE
-----------------------------------
*/

.title{

    text-align:center;

    color:white;

    font-size:50px;

    font-weight:bold;

    margin-bottom:35px;

}


/*
-----------------------------------
TABLE BOX
-----------------------------------
*/

.table-box{

    width:95%;

    margin:auto;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    -webkit-backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,0.20);

    border-radius:20px;

    padding:30px;

    overflow:auto;

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

table th{

    background:rgba(255,255,255,0.20);

    padding:15px;

    font-size:18px;

}

table td{

    padding:14px;

    text-align:center;

    border-bottom:1px solid rgba(255,255,255,0.15);

}


/*
-----------------------------------
BUTTONS
-----------------------------------
*/

.edit-btn{

    background:#007bff;

    color:white;

    border:none;

    padding:8px 15px;

    border-radius:8px;

    text-decoration:none;

    margin-right:5px;

}

.delete-btn{

    background:#dc3545;

    color:white;

    border:none;

    padding:8px 15px;

    border-radius:8px;

    text-decoration:none;

}

.edit-btn:hover,
.delete-btn:hover{

    opacity:0.85;

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

}

.logout-btn:hover{

    transform:scale(1.05);

}

</style>

</head>

<body>


<!-- LOGOUT -->


<a href="logout.php"
   class="logout-btn">

   Logout

</a>



<!-- SLIDESHOW -->


<div class="slideshow">

    <img src="slide1.jpg">

    <img src="slide2.jpg">

    <img src="slide3.jpg">

</div>



<!-- OVERLAY -->


<div class="overlay">


    <div class="title">

        Employee Management System

    </div>



    <div class="table-box">


        <table>


            <tr>

                <th>ID</th>

                <th>Full Name</th>

                <th>DOB</th>

                <th>Gender</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Department</th>

                <th>Employee ID</th>

                <th>Username</th>

                <th>Actions</th>

            </tr>



<?php

while($row = mysqli_fetch_assoc($result)){

?>


<tr>

    <td>

        <?php echo $row['id']; ?>

    </td>


    <td>

        <?php echo $row['full_name']; ?>

    </td>


    <td>

        <?php echo $row['dob']; ?>

    </td>


    <td>

        <?php echo $row['gender']; ?>

    </td>


    <td>

        <?php echo $row['email']; ?>

    </td>


    <td>

        <?php echo $row['phone']; ?>

    </td>


    <td>

        <?php echo $row['department']; ?>

    </td>


    <td>

        <?php echo $row['employee_id']; ?>

    </td>


    <td>

        <?php echo $row['username']; ?>

    </td>


    <td>


        <!-- EDIT -->


        <a href="edit.php?id=<?php echo $row['id']; ?>"
           class="edit-btn">

           Edit

        </a>



        <!-- DELETE -->


        <a href="home.php?delete=<?php echo $row['id']; ?>"
           class="delete-btn"

           onclick="return confirm('Delete Employee?')">

           Delete

        </a>

    </td>

</tr>


<?php

}

?>


        </table>

    </div>

</div>

</body>
</html>