<!DOCTYPE html>
<?php
include('func1.php');
$pid = '';
$ID = '';
$appdate = '';
$apptime = '';
$fname = '';
$lname = '';
$doctor = isset($_SESSION['dname']) ? $_SESSION['dname'] : '';
$con = mysqli_connect("localhost", "root", "", "hospitalms");
$gender = '';

if (isset($_GET['pid'], $_GET['ID'], $_GET['appdate'], $_GET['apptime'], $_GET['fname'], $_GET['lname'])) 
{
    $pid = $_GET['pid'];
    $ID = $_GET['ID'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $appdate = $_GET['appdate'];
    $apptime = $_GET['apptime'];
}

if (isset($_POST['prescribe'], $_POST['pid'], $_POST['ID'], $_POST['appdate'], $_POST['apptime'], $_POST['lname'], $_POST['fname'])) {
    $appdate = $_POST['appdate'];
    $apptime = $_POST['apptime'];
    $disease = $_POST['disease'];
    $allergy = $_POST['allergy'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pid = $_POST['pid'];
    $ID = $_POST['ID'];
    $prescription = $_POST['prescription'];

    if ($con) 
    {
        $query = mysqli_query($con, "INSERT INTO prestb(doctor, pid, ID, fname, lname, appdate, apptime, disease, allergy, prescription) VALUES ('$doctor', '$pid', '$ID', '$fname', '$lname', '$appdate', '$apptime', '$disease', '$allergy', '$prescription')");

        if ($query) {
            echo "<script>alert('Prescribed successfully!');</script>";
        } else {
            echo "<script>alert('Unable to process your request. Try again!');</script>";
        }

        echo "<script>alert('Patient ID: $pid');</script>";
    } else {
        echo "<script>alert('Database connection not established!');</script>";
    }
}

?>

<html lang="en">
  <head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, -scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospital Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <style >
    .bg-primary {
      background: #F0F2F0;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #000C40, #F0F2F0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #342ac1;
    border-color: #007bff;
}
.text-primary {
    color: #342ac1!important;
}

.btn-primary{
  background-color: #3c50c1;
  border-color: #3c50c1;
}
  </style>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout1.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        
      </li>
       <li class="nav-item">
       <a class="nav-link" href="doctor-panel.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Back</a>
      </li>
    </ul>
  </div>
</nav>

</head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>

<body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $doctor ?>
   </h3>

   <div class="tab-pane" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
        <form class="form-group" name="prescribeform" method="post" action="prescribe.php">
        
          <div class="row">
            <div class="container">
              <div class="form-group">
                <label>Disease:</label>
                <textarea id="disease" class="form-control" rows ="5" name="disease" required></textarea>
              </div>
    
              <div class="form-group">
                <label>Allergies:</label>
                <textarea id="allergy" class="form-control" rows ="5" name="allergy" required></textarea>
              </div>
    
              <div class="form-group">
                <label>Prescription:</label>
                <textarea id="prescription"class="form-control" rows ="5" name="prescription" required></textarea>
              </div>
                      
                     
                      
                      </div><br>
                      <input type="hidden" name="fname" value="<?php echo $fname ?>" />
                      <input type="hidden" name="lname" value="<?php echo $lname ?>" />
                      <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />
                      <input type="hidden" name="apptime" value="<?php echo $apptime ?>" />
                      <input type="hidden" name="pid" value="<?php echo $pid ?>" />
                      <input type="hidden" name="ID" value="<?php echo $ID ?>" />
                      <br><br>
                  <input type="submit" name="prescribe" value="Prescribe" class="btn btn-primary" style="margin-left: 40pc;">
            </div>
          </div>
          
        </form>
        <br>
        
      </div>
      </div>
      

  
