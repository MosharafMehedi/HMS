<!DOCTYPE html>
<?php
include('func1.php');
$con_hospitalms = mysqli_connect("localhost", "root", "", "hospitalms");
$con_hospitalms1 = mysqli_connect("localhost", "root", "", "hospitalms1");

$doctor = $_SESSION['dname'];

if (isset($_GET['cancel'])) {
    $query_hospitalms = mysqli_query($con_hospitalms, "update appointmenttb set doctorStatus='0' where ID = '" . $_GET['ID'] . "'");
    $query_hospitalms1 = mysqli_query($con_hospitalms1, "update appointmenttb set doctorStatus='0' where ID = '" . $_GET['ID'] . "'");
    if ($query_hospitalms || $query_hospitalms1) {
        echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}

// if(isset($_GET['prescribe'])){
//   $pid = $_GET['pid'];
//   $ID = $_GET['ID'];
//   $appdate = $_GET['appdate'];
//   $apptime = $_GET['apptime'];
//   $disease = $_GET['disease'];
//   $allergy = $_GET['allergy'];
//   $prescription = $_GET['prescription'];
//   $query=mysqli_query($con,"insert into prestb(doctor,pid,ID,appdate,apptime,disease,allergy,prescription) values ('$doctor',$pid,$ID,'$appdate','$apptime','$disease','$allergy','$prescription');");
//   if($query)
//   {
//     echo "<script>alert('Prescribed successfully!');</script>";
//   }
//   else{
//     echo "<script>alert('Unable to process your request. Try again!');</script>";
//   }
// }
?>
<html lang="en">
  <head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospital Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <style >
      .btn-outline-light:hover{
        color: #25bef7;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
      }
    </style>

  <style >
    .bg-primary {
      background: #F0F2F0;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #000C40, #F0F2F0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.list-group-item.active {
  z-index: 2;
    color: #fff;
    background: #F0F2F0; 
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);
    background: linear-gradient(to right, #000C40, #F0F2F0);
    border-color: #c3c3c3;
}
.text-primary {
    color: #342ac1!important;
}
  </style>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout1.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
      <input type="submit" class="btn btn-primary" id="inputbtn" name="search_submit" value="Search">
    </form>
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $_SESSION['dname'] ?>  </h3>
    <div class="row">
  <div class="col-md-4" style="max-width:18%;margin-top: 3%;">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">Dashboard</a>
      <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Appointments</a>
      <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home"> Prescription List</a>
      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">
      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        
              <div class="container-fluid container-fullw bg-white" >
              <div class="row">

               <div class="col-sm-4" style="left: 10%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> View Appointments</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>                      
                      <p class="links cl-effect-1">
                        <a href="#list-app" onclick="clickDiv('#list-app-list')">
                          Appointment List
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 15%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-file-powerpoint-o fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Prescriptions</h4>
                        
                      <p class="links cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          Prescription List
                        </a>
                      </p>
                    </div>
                  </div>
                </div>    

             </div>
           </div>
         </div>
    

    <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-home-list">
        
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Patient</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Prescribe</th>

                  </tr>
                </thead>
                <tbody>
                <?php 
$con1 = mysqli_connect("localhost", "root", "", "hospitalms");
$con2 = mysqli_connect("localhost", "root", "", "hospitalms1");

if (!$con1 || !$con2) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

$dname = $_SESSION['dname'];
$query1 = "SELECT pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus FROM hospitalms.appointmenttb WHERE doctor='$dname';";
$query2 = "SELECT pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus FROM hospitalms1.appointmenttb WHERE doctor='$dname';";

$result1 = mysqli_query($con1, $query1);
$result2 = mysqli_query($con2, $query2);

$cnt = 1;

while ($row = mysqli_fetch_array($result1)) {
    ?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['contact'];?></td>
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
        <td>
            <?php 
            if(($row['userStatus']==1) && ($row['doctorStatus']==1))  {
                echo "Active";
            } elseif(($row['userStatus']==0) && ($row['doctorStatus']==1)) {
                echo "Cancelled by Patient";
            } elseif(($row['userStatus']==1) && ($row['doctorStatus']==0)) {
                echo "Cancelled by You";
            }
            ?>
        </td>
        <td>
            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button></a>
            <?php } else {
                echo "Cancelled";
            } ?>
        </td>
        <td>
            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>&apptime=<?php echo $row['apptime']?>"
                tooltip-placement="top" tooltip="Remove" title="prescribe">
                <button class="btn btn-success">Prescribe</button></a>
            <?php } else {
                echo "-";
            } ?>
        </td>
    </tr>
    <?php
    $cnt++;
}

while ($row = mysqli_fetch_array($result2)) {
    ?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['contact'];?></td>
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
        <td>
            <?php 
            if(($row['userStatus']==1) && ($row['doctorStatus']==1))  {
                echo "Active";
            } elseif(($row['userStatus']==0) && ($row['doctorStatus']==1)) {
                echo "Cancelled by Patient";
            } elseif(($row['userStatus']==1) && ($row['doctorStatus']==0)) {
                echo "Cancelled by You";
            }
            ?>
        </td>
        <td>
            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button></a>
            <?php } else {
                echo "Cancelled";
            } ?>
        </td>
        <td>
            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>&apptime=<?php echo $row['apptime']?>"
                tooltip-placement="top" tooltip="Remove" title="prescribe">
                <button class="btn btn-success">Prescribe</button></a>
            <?php } else {
                echo "-";
            } ?>
        </td>
    </

    </tr>
    <?php
    $cnt++;
}

// Close the connections
mysqli_close($con1);
mysqli_close($con2);
?>


                </tbody>
              </table>
        <br>
      </div>

      

      <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
        <table class="table table-hover">
                <thead>
                  <tr>
                    
                    <th scope="col">#</th>
                    <th scope="col">Patient</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Disease</th>
                    <th scope="col">Allergy</th>
                    <th scope="col">Prescribe</th>
                  </tr>
                </thead>
                <tbody>
                <?php 



$con1 = mysqli_connect("localhost", "root", "", "hospitalms");
if (!$con1) {
    die("Connection to the first database failed: " . mysqli_connect_error());
}

// Second database connection
$con2 = mysqli_connect("localhost", "root", "", "hospitalms1");
if (!$con2) {
    die("Connection to the second database failed: " . mysqli_connect_error());
}

// Fetch data from the first database
$query1 = "SELECT pid, fname, lname, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE doctor='$doctor'";
$result1 = mysqli_query($con1, $query1);
if (!$result1) {
    echo mysqli_error($con1);
}

$cnt = 1;

// Display data from the first database
while ($row = mysqli_fetch_array($result1)){
    ?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>                        
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
        <td><?php echo $row['disease'];?></td>
        <td><?php echo $row['allergy'];?></td>
        <td><?php echo $row['prescription'];?></td>
    </tr>
    <?php 
    $cnt++; 
} 

// Fetch data from the second database
$query2 = "SELECT pid, fname, lname, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE doctor='$doctor'";
$result2 = mysqli_query($con2, $query2);
if (!$result2) {
    echo mysqli_error($con2);
}

// Display data from the second database
while ($row = mysqli_fetch_array($result2)){
    ?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>                        
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
        <td><?php echo $row['disease'];?></td>
        <td><?php echo $row['allergy'];?></td>
        <td><?php echo $row['prescription'];?></td>
    </tr>
    <?php 
    $cnt++; 
} 

// Close the connections
mysqli_close($con1);
mysqli_close($con2);
?>

                </tbody>
              </table>
      </div>




      <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">
        
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Consultancy Fees</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                  </tr>
                </thead>
                <tbody>
                <?php
$con1 = mysqli_connect("localhost", "root", "", "hospitalms");
if (!$con1) {
    die("Connection to the first database failed: " . mysqli_connect_error());
}

$con2 = mysqli_connect("localhost", "root", "", "hospitalms1");
if (!$con2) {
    die("Connection to the second database failed: " . mysqli_connect_error());
}

$query1 = "SELECT fname, lname, email, contact, doctor, docFees, appdate, apptime FROM appointmenttb";
$result1 = mysqli_query($con1, $query1);
if (!$result1) {
    die("Error in the first database query: " . mysqli_error($con1));
}

$query2 = "SELECT fname, lname, email, contact, doctor, docFees, appdate, apptime FROM appointmenttb";
$result2 = mysqli_query($con2, $query2);
if (!$result2) {
    die("Error in the second database query: " . mysqli_error($con2));
}

while ($row = mysqli_fetch_array($result1)) {
    echo "<tr>
    <td>{$row['fname']}</td>
    <td>{$row['lname']}</td>
    <td>{$row['email']}</td>
    <td>{$row['contact']}</td>
    <td>{$row['doctor']}</td>
    <td>{$row['docFees']}</td>
    <td>{$row['appdate']}</td>
    <td>{$row['apptime']}</td>
    </tr>";
}

while ($row = mysqli_fetch_array($result2)) {
    echo "<tr>
    <td>{$row['fname']}</td>
    <td>{$row['lname']}</td>
    <td>{$row['email']}</td>
    <td>{$row['contact']}</td>
    <td>{$row['doctor']}</td>
    <td>{$row['docFees']}</td>
    <td>{$row['appdate']}</td>
    <td>{$row['apptime']}</td>
    </tr>";
}

mysqli_close($con1);
mysqli_close($con2);
?>

                </tbody>
              </table>
        <br>
      </div>





      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="admin-panel1.php">
          <div class="row">
                  <div class="col-md-4"><label>Doctor Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="doctor" required></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="password" class="form-control"  name="dpassword" required></div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="demail" required></div><br><br>
                  <div class="col-md-4"><label>Consultancy Fees:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="docFees" required></div><br><br>
                </div>
          <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
        </form>
      </div>
       <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>
    </div>
  </div>
</div>
   </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>