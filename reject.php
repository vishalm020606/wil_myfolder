<?php

session_start();

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
REJECT REQUEST
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


    header("Location: travel_approval.php");

    exit();

}

?>