<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hospitalms");
$con1 = mysqli_connect("localhost", "root", "", "hospitalms1");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check connection for the second database
if ($con1->connect_error) {
    die("Connection failed: " . $con1->connect_error);
}

if (isset($_POST['patsub'])) {
    $email = $_POST['email'];
    $password = $_POST['password2'];

    $query1 = "SELECT * FROM patreg WHERE email='$email' AND password='$password';";
    $result1 = $con->query($query1);

    // Query the second database
    $query2 = "SELECT * FROM patreg WHERE email='$email' AND password='$password';";
    $result2 = $con1->query($query2);

    if ($result1->num_rows == 1) {
        // User found in the first database
        $row1 = $result1->fetch_assoc();
        // Set session variables for user data
        $_SESSION['pid'] = $row1['pid'];
        $_SESSION['username'] = $row1['fname'] . " " . $row1['lname'];
        $_SESSION['fname'] = $row1['fname'];
        $_SESSION['lname'] = $row1['lname'];
        $_SESSION['gender'] = $row1['gender'];
        $_SESSION['contact'] = $row1['contact'];
        $_SESSION['email'] = $row1['email'];

        // Redirect to admin panel
        header("Location: admin-panel.php");
        exit();
    } elseif ($result2->num_rows == 1) {
        // User found in the second database
        $row2 = $result2->fetch_assoc();
        // Set session variables for user data
        $_SESSION['pid'] = $row2['pid'];
        $_SESSION['username'] = $row2['fname'] . " " . $row2['lname'];
        $_SESSION['fname'] = $row2['fname'];
        $_SESSION['lname'] = $row2['lname'];
        $_SESSION['gender'] = $row2['gender'];
        $_SESSION['contact'] = $row2['contact'];
        $_SESSION['email'] = $row2['email'];

        // Redirect to admin panel
        header("Location: admin-panel.php");
        exit();
    } else {
        echo ("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index1.php';</script>");
        // header("Location:error.php");
    }
}




if (isset($_POST['update_data'])) {
  $contact = $_POST['contact'];
  $status = $_POST['status'];

  // Establish the connection for the first database (hospitalms)
  $con_hospitalms = mysqli_connect("localhost", "root", "", "hospitalms");
  if (!$con_hospitalms) {
      die("Connection to hospitalms database failed: " . mysqli_connect_error());
  }

  // Establish the connection for the second database (hospitalms1)
  $con_hospitalms1 = mysqli_connect("localhost", "root", "", "hospitalms1");
  if (!$con_hospitalms1) {
      die("Connection to hospitalms1 database failed: " . mysqli_connect_error());
  }

  if ($spec == 'Cardiologist' || $spec == 'Neurologist' || $spec == 'Pediatrician' || $spec == 'Gynecologist') {
      $con = $con_hospitalms;
  } else {
      $con = $con_hospitalms1;
  }

  $query = "UPDATE appointmenttb SET payment='$status' WHERE contact='$contact';";
  $result = mysqli_query($con, $query);
  if ($result) {
      header("Location:updated.php");
  }
}




// function display_docs()
// {
// 	global $con;
// 	$query="select * from doctb";
// 	$result=mysqli_query($con,$query);
// 	while($row=mysqli_fetch_array($result))
// 	{
// 		$name=$row['name'];
//     $cost=$row['docFees'];
// 		echo '<option value="'.$name.'" data-price="' .$cost. '" >'.$name.'</option>';
// 	}
// }

if (isset($_POST['doc_sub'])) {
  $doctorname = $_POST['doctorname'];
  $doctor = $_POST['doctor'];
  $dpassword = $_POST['dpassword'];
  $demail = $_POST['demail'];
  $docFees = $_POST['docFees'];

  // Establish the connection for the first database (hospitalms)
  $con_hospitalms = mysqli_connect("localhost", "root", "", "hospitalms");
  if (!$con_hospitalms) {
      die("Connection to hospitalms database failed: " . mysqli_connect_error());
  }

  // Establish the connection for the second database (hospitalms1)
  $con_hospitalms1 = mysqli_connect("localhost", "root", "", "hospitalms1");
  if (!$con_hospitalms1) {
      die("Connection to hospitalms1 database failed: " . mysqli_connect_error());
  }

  if ($spec == 'Cardiologist' || $spec == 'Neurologist' || $spec == 'Pediatrician' || $spec == 'Gynecologist') {
      $con = $con_hospitalms;
  } else {
      $con = $con_hospitalms1;
  }

  $query = "INSERT INTO doctb(doctorname, username, password, email, docFees) VALUES ('$doctorname', '$doctor', '$dpassword', '$demail', '$docFees')";
  $result = mysqli_query($con, $query);
  if ($result) {
      header("Location:adddoc.php");
  }
}

function display_admin_panel(){
	echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospital Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="enter contact number" aria-label="Search" name="contact">
      <input type="submit" class="btn btn-outline-light my-2 my-sm-0 btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
    </form>
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
 <div class="jumbotron" id="ab1"></div>
   <div class="container-fluid" style="margin-top:50px;">
    <div class="row">
  <div class="col-md-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Appointment</a>
      <a class="list-group-item list-group-item-action" href="patientdetails.php" role="tab" aria-controls="home">Patient List</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Payment Status</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Prescription</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Doctors Section</a>
       <a class="list-group-item list-group-item-action" id="list-attend-list" data-toggle="list" href="#list-attend" role="tab" aria-controls="settings">Attendance</a>
    </div><br>
  </div>

  





  <div class="col-md-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <center><h4>Create an appointment</h4></center><br>
              <form class="form-group" method="post" action="appointment.php">
                <div class="row">
                  <div class="col-md-4"><label>First Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="fname"></div><br><br>
                  <div class="col-md-4"><label>Last Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="lname"></div><br><br>
                  <div class="col-md-4"><label>Email id:</label></div>
                  <div class="col-md-8"><input type="text"  class="form-control" name="email"></div><br><br>
                  <div class="col-md-4"><label>Contact Number:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="contact"></div><br><br>
                  <div class="col-md-4"><label>Doctor:</label></div>
                  <div class="col-md-8">
                   <select name="doctor" class="form-control" >

                     <!-- <option value="" disabled selected>Select Doctor</option>
                     <option value="Dr. Punam Shaw">Dr. Punam Shaw</option>
                      <option value="Dr. Ashok Goyal">Dr. Ashok Goyal</option> -->
                      <?php display_docs();?>




                    </select>
                  </div><br><br>
                  <div class="col-md-4"><label>Payment:</label></div>
                  <div class="col-md-8">
                    <select name="payment" class="form-control" >
                      <option value="" disabled selected>Select Payment Status</option>
                      <option value="Paid">Paid</option>
                      <option value="Pay later">Pay later</option>
                    </select>
                  </div><br><br><br>
                  <div class="col-md-4">
                    <input type="submit" name="entry_submit" value="Create new entry" class="btn btn-primary" id="inputbtn">
                  </div>
                  <div class="col-md-8"></div>                  
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card">
          <div class="card-body">
            <form class="form-group" method="post" action="func.php">
              <input type="text" name="contact" class="form-control" placeholder="enter contact"><br>
              <select name="status" class="form-control">
               <option value="" disabled selected>Select Payment Status to update</option>
                <option value="paid">paid</option>
                <option value="pay later">pay later</option>
              </select><br><hr>
              <input type="submit" value="update" name="update_data" class="btn btn-primary">
            </form>
          </div>
        </div><br><br>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="func.php">
          <label>Doctors name: </label>
          <input type="text" name="name" placeholder="enter doctors name" class="form-control">
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
    <!--Sweet alert js-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
   <script type="text/javascript">
   $(document).ready(function(){
   	swal({
  title: "Welcome!",
  text: "Have a nice day!",
  imageUrl: "images/sweet.jpg",
  imageWidth: 400,
  imageHeight: 200,
  imageAlt: "Custom image",
  animation: false
})</script>
  </body>
</html>';
}
?>