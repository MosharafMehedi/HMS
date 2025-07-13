<!DOCTYPE html>
<?php 
include('func.php');  
include('newfunc.php');
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : '';
$pid = isset($_SESSION['pid']) ? $_SESSION['pid'] : '';

if($gender == 'Male'){
  $con=mysqli_connect("localhost","root","","hospitalms");
}
elseif($gender == 'Female'){
  $con=mysqli_connect("localhost","root","","hospitalms1");
}
else
{

}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : '';
$lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : '';
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : '';
$contact = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';

if(isset($_POST['app-submit'])){
  $pid = isset($_SESSION['pid']) ? $_SESSION['pid'] : '';
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
  $fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : '';
  $lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : '';
  $gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : '';
  $contact = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';
  $doctor=$_POST['doctor'];
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
  
  $docFees=$_POST['docFees'];
  $appdate=$_POST['appdate'];
  $apptime=$_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s");
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);

  if (date("Y-m-d", $appdate1) >= $cur_date) {
    if ((date("Y-m-d", $appdate1) == $cur_date && date("H:i:s", $apptime1) > $cur_time) || date("Y-m-d", $appdate1) > $cur_date) {
        if ($gender == 'Male') {
            $con = mysqli_connect("localhost", "root", "", "hospitalms");
        } elseif ($gender == 'Female') {
            $con = mysqli_connect("localhost", "root", "", "hospitalms1");
        } else {
            // Handle other cases or errors
        }

        $check_query = mysqli_query($con, "select apptime from appointmenttb where doctor='$doctor' and appdate='$appdate' and apptime='$apptime'");

        if (mysqli_num_rows($check_query) == 0) {
            $query = mysqli_query($con, "insert into appointmenttb(pid, fname, lname, gender, email, contact, doctor, docFees, appdate, apptime, userStatus, doctorStatus) values('$pid', '$fname', '$lname', '$gender', '$email', '$contact', '$doctor', '$docFees', '$appdate', '$apptime', '1', '1')");

            if ($query) {
                echo "<script>alert('Your appointment has been successfully booked');</script>";
            } else {
                echo "<script>alert('Unable to process your request. Please try again!');</script>";
            }
        } else {
            echo "<script>alert('We apologize, but the doctor is not available at this time or date. Please select a different time or date!');</script>";
        }
    } else {
        echo "<script>alert('Please select a time or date in the future!');</script>";
    }
} else {
    echo "<script>alert('Please select a time or date in the future!');</script>";
}

  
}


if(isset($_GET['cancel'])){
  if($gender == 'Male'){
    $con=mysqli_connect("localhost","root","","hospitalms");
  }
  elseif($gender == 'Female'){
    $con=mysqli_connect("localhost","root","","hospitalms1");
  }
  else{
    // Handle other cases or errors
  }
  $query=mysqli_query($con,"update appointmenttb set userStatus='0' where ID = '".$_GET['ID']."'");
  if($query){
    echo "<script>alert('Your appointment successfully cancelled');</script>";
  }
}

function generate_bill(){
  $gender = $_SESSION['gender'];
  if($gender == 'Male'){
      $con=mysqli_connect("localhost","root","","hospitalms");
  }
  elseif($gender == 'Female'){
      $con=mysqli_connect("localhost","root","","hospitalms1");
  }
  else{
      // Handle other cases or errors
  }
  
  $pid = $_SESSION['pid'];
  $output='';
  if ($con) {
      $query = "SELECT * FROM prestb WHERE pid = '$pid' AND ID = '".$_GET['ID']."'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)){
          $output .= '
          <label> Bill No : </label>HMS_'.$row["pid"].$row["ID"].'<br/><br/>
          <label> Patient : </label>'.$row["fname"].' '.$row["lname"].'<br/><br/>
          <label> Doctor : </label>'.$row["doctor"].'<br/><br/>
          <label> Appointment Date : </label>'.$row["appdate"].'<br/><br/>
          <label> Appointment Time : </label>'.$row["apptime"].'<br/><br/>
          <label> Disease : </label>'.$row["disease"].'<br/><br/>
          <label> Allergies : </label>'.$row["allergy"].'<br/><br/>
          <label> Prescription : </label>'.$row["prescription"].'<br/><br/>
          ';
      }
      echo $output; // output the result
  } else {
      echo "<script>alert('Database connection not established!');</script>";
  }
}



function get_specs(){
  $con = mysqli_connect("localhost", "root", "", "hospitalms");
  $con1 = mysqli_connect("localhost", "root", "", "hospitalms1");

  $query1 = mysqli_query($con, "SELECT username, spec FROM doctb");
  $query2 = mysqli_query($con1, "SELECT username, spec FROM doctb"); // Replace 'column1' and 'column2' with the actual column names and 'table_name' with the actual table name in 'hospitalms1' database

  $docarray1 = array();
  $docarray2 = array();

  while($row = mysqli_fetch_assoc($query1)) {
    $docarray1[] = $row;
  }

  while($row = mysqli_fetch_assoc($query2)) {
    $docarray2[] = $row;
  }

  $result = array("database1_data" => $docarray1, "database2_data" => $docarray2);

  return json_encode($result);
}



?>
<html lang="en">
  <head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    /* background: -webkit-linear-gradient(left, #3931af, #00c6ff); */
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

.btn-primary{
  background-color: #3c50c1;
  border-color: #3c50c1;
}
  </style>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
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
    <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $username ?> 
   </h3>
    <div class="row">
  <div class="col-md-4" style="max-width:25%; margin-top: 3%">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
      <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Book Appointment</a>
      <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Appointment History</a>
      <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">Prescriptions</a>
      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">


      <div class="tab-pane fade  show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-fullw bg-white" >
              <div class="row">
               <div class="col-sm-4" style="left: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-bookmark fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Book My Appointment</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>                      
                      <p class="links cl-effect-1">
                        <a href="#list-home" onclick="clickDiv('#list-home-list')">
                          Book Appointment
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 10%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">My Appointments</h2>
                    
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                          View Appointment History
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                </div>

                <div class="col-sm-4" style="left: 20%;margin-top:5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-file-powerpoint-o fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Prescriptions</h2>
                    
                      <p class="cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          View Prescription List
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                
         
            </div>
          </div>





      <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <center><h4>Book Appointment</h4></center><br>
              <form class="form-group" method="post" action="admin-panel.php">
                <div class="row">
                  
                  <!-- <<?php
// Begin session
session_start();

// First database connection
$con1 = mysqli_connect("localhost", "root", "", "hospitalms");

// Second database connection
$con2 = mysqli_connect("localhost", "root", "", "hospitalms1");

// Check if the connections are successful
if (!$con1 || !$con2) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the first database
$docarray1 = [];
$query1 = mysqli_query($con1, "SELECT username, spec FROM doctb");
while ($row = mysqli_fetch_assoc($query1)) {
    $docarray1[] = $row;
}

// Fetch data from the second database
$docarray2 = [];
$query2 = mysqli_query($con2, "SELECT username, spec FROM doctb");
while ($row = mysqli_fetch_assoc($query2)) {
    $docarray2[] = $row;
}

// Combine the results
$result = [
    "database1_data" => $docarray1,
    "database2_data" => $docarray2
];

// Convert the result to JSON format
echo json_encode($result);

// Close the connections
mysqli_close($con1);
mysqli_close($con2);
?>


-->


                    <div class="col-md-4">
                          <label for="spec">Specialization:</label>
                        </div>
                        <div class="col-md-8">
                          <select name="spec" class="form-control" id="spec">
                              <option value="" disabled selected>Select Specialization</option>
                              <?php 
                              display_specs();
                              ?>
                          </select>
                        </div>

                        <br><br>

                        <script>
                      document.getElementById('spec').onchange = function foo() {
                        let spec = this.value;   
                        console.log(spec)
                        let docs = [...document.getElementById('doctor').options];
                        
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != spec ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };

                  </script>

              <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                <div class="col-md-8">
                    <select name="doctor" class="form-control" id="doctor" required="required">
                      <option value="" disabled selected>Select Doctor</option>
                
                      <?php display_docs(); ?>
                    </select>
                  </div><br/><br/> 


                        <script>
              document.getElementById('doctor').onchange = function updateFees(e) {
                var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                document.getElementById('docFees').value = selection;
              };
            </script>

                  
                  

                  
                        <!-- <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                                <div class="col-md-8">
                                    <select name="doctor" class="form-control" id="doctor1" required="required">
                                      <option value="" disabled selected>Select Doctor</option>
                                      
                                    </select>
                                </div>
                                <br><br> -->

                                <!-- <script>
                                  document.getElementById("spec").onchange = function updateSpecs(event) {
                                      var selected = document.querySelector(`[data-value=${this.value}]`).getAttribute("value");
                                      console.log(selected);

                                      var options = document.getElementById("doctor1").querySelectorAll("option");

                                      for (i = 0; i < options.length; i++) {
                                        var currentOption = options[i];
                                        var category = options[i].getAttribute("data-spec");

                                        if (category == selected) {
                                          currentOption.style.display = "block";
                                        } else {
                                          currentOption.style.display = "none";
                                        }
                                      }
                                    }
                                </script> -->

                        
                    <!-- <script>
                    let data = 
                
              document.getElementById('spec').onchange = function updateSpecs(e) {
                let values = data.filter(obj => obj.spec == this.value).map(o => o.username);   
                document.getElementById('doctor1').value = document.querySelector(`[value=${values}]`).getAttribute('data-value');
              };
            </script> -->


                  
                  <div class="col-md-4"><label for="consultancyfees">
                                Consultancy Fees
                              </label></div>
                              <div class="col-md-8">
                              <!-- <div id="docFees">Select a doctor</div> -->
                              <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly"/>
                  </div><br><br>

                  <div class="col-md-4"><label>Appointment Date</label></div>
                  <div class="col-md-8"><input type="date" class="form-control datepicker" name="appdate"></div><br><br>

                  <div class="col-md-4"><label>Appointment Time</label></div>
                  <div class="col-md-8">
                    <!-- <input type="time" class="form-control" name="apptime"> -->
                    <select name="apptime" class="form-control" id="apptime" required="required">
                      <option value="" disabled selected>Select Time</option>
                      <option value="08:00:00">8:00 AM</option>
                      <option value="10:00:00">10:00 AM</option>
                      <option value="12:00:00">12:00 PM</option>
                      <option value="14:00:00">2:00 PM</option>
                      <option value="16:00:00">4:00 PM</option>
                    </select>

                  </div><br><br>

                  <div class="col-md-4">
                    <input type="submit" name="app-submit" value="Create new entry" class="btn btn-primary" id="inputbtn">
                  </div>
                  <div class="col-md-8"></div>                  
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>
      
<div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">
        
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Fees</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
if ($gender == 'Male') {
    $con = mysqli_connect("localhost", "root", "", "hospitalms");
} elseif ($gender == 'Female') {
    $con = mysqli_connect("localhost", "root", "", "hospitalms1");
} else {
    // Handle other cases or errors
}

$query = "select  ID, doctor, docFees, appdate, apptime, userStatus, doctorStatus from appointmenttb where fname ='$fname' and lname='$lname';";
$result = mysqli_query($con, $query);
$cnt = 1;
while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo $row['doctor'];?></td>
        <td><?php echo '$'.$row['docFees'];?></td>
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
    
        
        <td>
            <?php 
            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                echo "Active";
            }
            if (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                echo "Cancelled by You";
            }

            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                echo "Cancelled by Doctor";
            }
            ?>
        </td>

        <td>
            <?php 
            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { 
            ?>
                <a href="admin-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                    onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                    title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">
                    <button class="btn btn-danger">Cancel</button>
                </a>
            <?php 
            } else {
                echo "Cancelled";
            } 
            ?>
        </td>
    </tr>
<?php 
$cnt++; 
} 
?>



                </tbody>
              </table>
        <br>
      </div>



      <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
        
              <table class="table table-hover">
                <thead>
                  <tr>
                    
                    <th scope="col">Doctor</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Diseases</th>
                    <th scope="col">Allergies</th>
                    <th scope="col">Prescriptions</th>
                    <th scope="col">Payment</th>
                  </tr>
                </thead>
                <tbody>
                <?php
if ($gender == 'Male') {
    $con = mysqli_connect("localhost", "root", "", "hospitalms");
    $query = "SELECT doctor, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE pid='$pid'";
} elseif ($gender == 'Female') {
    $con = mysqli_connect("localhost", "root", "", "hospitalms1");
    $query = "SELECT doctor, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE pid='$pid'";
} else {
    // Handle other cases or errors
    exit("Invalid gender specified.");
}

$result = mysqli_query($con, $query);

if (!$result) {
    echo mysqli_error($con);
}

while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row['doctor'];?></td>
        <td><?php echo $row['appdate'];?></td>
        <td><?php echo $row['apptime'];?></td>
        <td><?php echo $row['disease'];?></td>
        <td><?php echo $row['allergy'];?></td>
        <td><?php echo $row['prescription'];?></td>
        <td>
            <form method="get">
                <a href="admin-panel.php?ID=<?php echo $row['ID']?>">
                    <input type="hidden" name="ID" value="<?php echo $row['ID']?>"/>
                    <input type="submit" onclick="alert('Bill Paid Successfully');" name="generate_bill" class="btn btn-success" value="Pay Bill"/>
                </a>
            </form>
        </td>
    </tr>
<?php 
} 
?>

                </tbody>
              </table>
        <br>
      </div>

      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="func.php">
          <label>Doctors name: </label>
          <input type="text" name="name" placeholder="Enter doctors name" class="form-control">
          <br>
          <input type="submit" name="doc_sub" value="Add Doctor" class="btn btn-primary">
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js">
   </script>



  </body>
</html>