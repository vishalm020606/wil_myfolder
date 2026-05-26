<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}


$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "wil_company"
);


/*
-----------------------------------
GET EMPLOYEE ID
-----------------------------------
*/

if(isset($_GET['id'])){

    $id = $_GET['id'];

}
else{

    die("Employee ID Missing");

}


/*
-----------------------------------
FETCH DATA
-----------------------------------
*/

$result = mysqli_query(

    $conn,

    "SELECT * FROM emp_details
     WHERE id='$id'"

);

$row = mysqli_fetch_assoc($result);


if(!$row){

    die("Employee Not Found");

}


/*
-----------------------------------
UPDATE
-----------------------------------
*/

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];

    $dob = $_POST['dob'];

    $gender = $_POST['gender'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $department = $_POST['department'];

    $username = $_POST['username'];


    mysqli_query(

        $conn,

        "UPDATE emp_details

         SET

         full_name='$full_name',
         dob='$dob',
         gender='$gender',
         email='$email',
         phone='$phone',
         department='$department',
         username='$username'

         WHERE id='$id'"

    );


    echo "

    <script>

        alert('Updated Successfully');

        window.location='home.php';

    </script>

    ";

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Edit Employee</title>

<style>

body{

    font-family:Arial;

    background:#f2f2f2;

    padding:40px;

}

.box{

    width:500px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:10px;

}

h2{

    margin-bottom:25px;

}

input,
select{

    width:100%;

    padding:12px;

    margin-top:8px;
    margin-bottom:18px;

}

button{

    width:100%;

    padding:14px;

    background:#007bff;

    color:white;

    border:none;

    font-size:18px;

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

<div class="box">

<h2>Edit Employee Details</h2>

<form method="POST">

Full Name:

<input type="text"
       name="full_name"
        autocomplete="off"
       value="<?php echo $row['full_name']; ?>">


Date Of Birth:

<input type="date"
       name="dob"
        autocomplete="off"
       value="<?php echo $row['dob']; ?>">


Gender:

<select name="gender">

<option>
<?php echo $row['gender']; ?>
</option>

<option>Male</option>

<option>Female</option>

</select>


Email:

<input type="email"
       name="email"
        autocomplete="off"
       value="<?php echo $row['email']; ?>">


Phone:

<input type="text"
       name="phone"
        autocomplete="off"
       value="<?php echo $row['phone']; ?>">


Department:

<input type="text"
       name="department"
        autocomplete="off"
       value="<?php echo $row['department']; ?>">


Employee ID:

<input type="text"
 autocomplete="off"
       value="<?php echo $row['employee_id']; ?>"
       disabled>


Username:

<input type="text"
       name="username"
        autocomplete="off"
       value="<?php echo $row['username']; ?>">


<button type="submit"
        name="update">

Update Employee

</button>

</form>

</div>

</body>
</html>