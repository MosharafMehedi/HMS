<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
    <title>Doctor Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
include("newfunc.php");
if(isset($_POST['doctor_search_submit']))
{
    $contact=$_POST['doctor_contact'];

    // Establish connection to the first database (hospitalms)
    $con=mysqli_connect("localhost","root","","hospitalms");
    if (!$con) {
        die("Connection to hospitalms database failed: " . mysqli_connect_error());
    }

    // Establish connection to the second database (hospitalms1)
    $con1=mysqli_connect("localhost","root","","hospitalms1");
    if (!$con1) {
        die("Connection to hospitalms1 database failed: " . mysqli_connect_error());
    }

    $query = "select * from doctb where email= '$contact'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $query1 = "select * from doctb where email= '$contact'";
    $result1 = mysqli_query($con1, $query1);
    $row1 = mysqli_fetch_array($result1);

    if(empty($row) && empty($row1)){
        echo "<script> alert('No entries found!'); 
          window.location.href = 'admin-panel1.php#list-doc';</script>";
    } else {
        echo "<div class='container-fluid' style='margin-top:50px;'>
        <div class ='card'>
        <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
        <table class='table table-hover'>
          <thead>
            <tr>
              <th scope='col'>Username</th>
              <th scope='col'>Password</th>
              <th scope='col'>Email</th>
              <th scope='col'>Consultancy Fees</th>
            </tr>
          </thead>
          <tbody>";

        if(!empty($row)){
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $docFees = $row['docFees'];
            echo "<tr>
              <td>$username</td>
              <td>$password</td>
              <td>$email</td>
              <td>$docFees</td>
            </tr>";
        }

        if(!empty($row1)){
            $username = $row1['username'];
            $password = $row1['password'];
            $email = $row1['email'];
            $docFees = $row1['docFees'];
            echo "<tr>
              <td>$username</td>
              <td>$password</td>
              <td>$email</td>
              <td>$docFees</td>
            </tr>";
        }
        echo "</tbody></table><center><a href='admin-panel1.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
    }

    // Close connections
    mysqli_close($con);
    mysqli_close($con1);
}
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</body>
</html>
