<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Edit</title>
</head>
<body>
<style type="text/css">
img.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
<br>
<img class="center" src="mit_logo.png" alt="MITAOE Logo">
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM `studmanagement`.`student` WHERE `studID`='$student_id' ";
                            $query1 = "SELECT * FROM `studmanagement`.`marks` WHERE `studID`='$student_id' ";
                            $query_run = mysqli_query($con, $query);
                            $query_run1 = mysqli_query($con, $query1);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                $mark = mysqli_fetch_array($query_run1);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?= $student['studID']; ?>">

                                    <div class="mb-3">
                                        <label>Student Name</label>
                                        <input type="text" name="name" value="<?=$student['name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student ID</label>
                                        <input type="text" name="studID" value="<?=$student['studID'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Phone</label>
                                        <input type="number" name="phone" value="<?=$student['phone'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Address</label>
                                        <input type="text" name="address" value="<?=$student['address'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student DOB</label>
                                        <input type="date" name="dob" value="<?=$student['dob'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                    <label>COA marks</label>
                                    <input type="number" name="COA" step="00.01" value="<?=$mark['COA'];?>">
                                    <label>DBMS marks</label>
                                    <input type="number" name="DBMS" step="00.01" value="<?=$mark['DBMS'];?>">
                                    <label>ADS marks</label>
                                    <input type="number" name="ADS" step="00.01" value="<?=$mark['ADS'];?>">
                                    <label>AM marks</label>
                                    <input type="number" name="AM" step="00.01" value="<?=$mark['AM'];?>">
                            </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>