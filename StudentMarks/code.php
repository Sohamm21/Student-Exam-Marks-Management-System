<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query1 = "DELETE FROM `studmanagement`.`marks` WHERE `studID`='$student_id'; ";
    $query_run1 = mysqli_query($con, $query1);
    if($query_run1){
        $query = "DELETE FROM `studmanagement`.`student` WHERE `studID`='$student_id'; ";
    }

    
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name =  $_POST['name'];
    $studID = $_POST['studID'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $coa = $_POST['COA'];
    $dbms = $_POST['DBMS'];
    $ads = $_POST['ADS'];
    $am = $_POST['AM'];
    $query = "UPDATE `studmanagement`.`student` SET `name`='$name', `phone`='$phone', `address`='$address', `dob`='$dob' WHERE `studID`='$student_id'; ";
    $query_run = mysqli_query($con, $query);
    $query1 = "UPDATE `studmanagement`.`marks` SET `COA`='$coa', `DBMS`='$dbms', `ADS`='$ads', `AM`='$am' WHERE `studID`='$student_id'; ";
    $query_run1 = mysqli_query($con, $query1);
    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }
}


if(isset($_POST['Save']))
{
    $name =  $_POST['name'];
    $studID = $_POST['studID'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $coa = $_POST['COA'];
    $dbms = $_POST['DBMS'];
    $ads = $_POST['ADS'];
    $am = $_POST['AM'];

    $query = "INSERT INTO `studmanagement`.`student` (`name`, `studID`, `phone`, `address`, `dob`) VALUES ('$name', '$studID', '$phone', '$address', '$dob');";
    $query_run = mysqli_query($con, $query);
    $query = "INSERT INTO `studmanagement`.`marks` (`studID`, `COA`, `DBMS`, `ADS`, `AM`) VALUES ('$studID', '$coa', '$dbms', '$ads', '$am');";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Details Created Successfully";
        header("Location: student_create.php");
        echo "inserted!";
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Details Not Created";
        header("Location: student_create.php");
        exit(0);
    }
}

?>