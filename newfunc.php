<?php
// session_start();
$con=mysqli_connect("localhost","root","","hospitalms");
$con1=mysqli_connect("localhost","root","","hospitalms1");
// if(isset($_POST['submit'])){
//  $username=$_POST['username'];
//  $password=$_POST['password'];
//  $query="select * from logintb where username='$username' and password='$password';";
//  $result=mysqli_query($con,$query);
//  if(mysqli_num_rows($result)==1)
//  {
//   $_SESSION['username']=$username;
//   $_SESSION['pid']=
//   header("Location:admin-panel.php");
//  }
//  else
//   header("Location:error.php");
// }
if(isset($_POST['update_data']))
{
 $contact=$_POST['contact'];
 $status=$_POST['status'];
 $query="update appointmenttb set payment='$status' where contact='$contact';";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:updated.php");
}

// function display_docs()
// {
//  global $con;
//  $query="select * from doctb";
//  $result=mysqli_query($con,$query);
//  while($row=mysqli_fetch_array($result))
//  {
//   $username=$row['username'];
//   $price=$row['docFees'];
//   echo '<option value="' .$username. '" data-value="'.$price.'">'.$username.'</option>';
//  }
// }


function display_specs() {
  $con=mysqli_connect("localhost","root","","hospitalms");

  $query="select distinct(spec) from doctb";
  $result1 = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result1)) {
      $spec = $row['spec'];
      echo '<option data-value="' . $spec . '">' . $spec . '</option>';
  }

  mysqli_close($con);

  $con1=mysqli_connect("localhost","root","","hospitalms1");
  $query="select distinct(spec) from doctb";
  $result2 = mysqli_query($con1, $query);
  while ($row = mysqli_fetch_array($result2)) {
      $spec = $row['spec'];
      echo '<option data-value="' . $spec . '">' . $spec . '</option>';
  }
  
  mysqli_close($con1);
}


function display_docs()
{
    // First Database Connection
    $con1 = mysqli_connect("localhost", "root", "", "hospitalms");
    $query1 = "select * from doctb";
    $result1 = mysqli_query($con1, $query1);

    // Second Database Connection
    $con2 = mysqli_connect("localhost", "root", "", "hospitalms1");
    $query2 = "select * from doctb";
    $result2 = mysqli_query($con2, $query2);

    // Fetch data from the first database
    while ($row1 = mysqli_fetch_array($result1)) {
        $username = $row1['username'];
        $price = $row1['docFees'];
        $spec = $row1['spec'];
        echo '<option value="' . $username . '" data-value="' . $price . '" data-spec="' . $spec . '">' . $username . '</option>';
    }

    // Fetch data from the second database
    while ($row2 = mysqli_fetch_array($result2)) {
        $username = $row2['username'];
        $price = $row2['docFees'];
        $spec = $row2['spec'];
        echo '<option value="' . $username . '" data-value="' . $price . '" data-spec="' . $spec . '">' . $username . '</option>';
    }

    // Close connections
    mysqli_close($con1);
    mysqli_close($con2);
}

// function display_specs() {
//   global $con;
//   $query = "select distinct(spec) from doctb";
//   $result = mysqli_query($con,$query);
//   while($row = mysqli_fetch_array($result))
//   {
//     $spec = $row['spec'];
//     $username = $row['username'];
//     echo '<option value = "' .$spec. '">'.$spec.'</option>';
//   }
// }


if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into doctb(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>