<?php
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student View</title>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Student Details 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </b></h3>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM `studmanagement`.`student` WHERE `studID`='$student_id';";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="mb-3">
                                        <label><b>Student Name: </b></label>
                                        <label>
                                            <?=$student['name'];?>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label><b>Student ID :</b></label>
                                        <label>
                                            <?=$student['studID'];?>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label><b>Student Phone: </b></label>
                                        <label>
                                            <?=$student['phone'];?>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label><b>Student Address: </b></label>
                                        <label>
                                            <?=$student['address'];?>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label><b>Student DOB: </b></label>
                                        <label>
                                            <?=$student['dob'];?>
                                        </label>
                                    </div>

                            <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>COA</th>
                                    <th>DBMS</th>
                                    <th>ADS</th>
                                    <th>AM</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM `studmanagement`.`marks` WHERE `studID`='$student_id';";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['COA']; ?></td>
                                                <td><?= $student['DBMS']; ?></td>
                                                <td><?= $student['ADS']; ?></td>
                                                <td><?= $student['AM']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        
                                    }

                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                            
                        </table>
                        
    
                                <?php
                                $query = "SELECT `COA` + `DBMS` + `ADS` + `AM` as `TOTAL` FROM `studmanagement`.`marks` WHERE `studID`='$student_id';";
                                $query_run = mysqli_query($con, $query);
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $student)
                                    {
                                        echo '<pre>';
                                        echo "<b>Total marks obtained: </b>" . $student['TOTAL'] . "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        echo "<b>Outoff: </b> 400";
                                        echo '</pre>';
                                        $total = $student['TOTAL'];
                                        $percentage = ($total/400)*100;
                                        $per =  number_format((float)$percentage, 2, '.', '');
                                        echo "<b>Percentage Obtained: </b>" . $per . "%";

                                        if($per>35){
                                            echo "<p align=right><b>PASS </b></p>";
                                        }
                                        else{
                                            echo "<p align=right><b>FAIL </b></p>";
                                        }
                                    }
                                    
                                }
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