<?php
session_start();

// First database connection
$con1 = mysqli_connect("localhost", "root", "", "hospitalms");
if (!$con1) {
    die("Connection to the first database failed: " . mysqli_connect_error());
}

// Second database connection
$con2 = mysqli_connect("localhost", "root", "", "hospitalms1");
if (!$con2) {
    die("Connection to the second database failed: " . mysqli_connect_error());
}

// Handle admin login
if (isset($_POST['adsub'])) {
    $username = $_POST['username1'];
    $password = $_POST['password2'];

    $query1 = "select * from admintb where username='$username' and password='$password';";
    $result1 = mysqli_query($con1, $query1);

    $query2 = "select * from admintb where username='$username' and password='$password';";
    $result2 = mysqli_query($con2, $query2);

    if (mysqli_num_rows($result1) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel1.php");
    } elseif (mysqli_num_rows($result2) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel1.php");
    } else {
        echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index.php';</script>");
    }
}

// Handle appointment update
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $query1 = "update appointmenttb set payment='$status' where contact='$contact';";
    $result1 = mysqli_query($con1, $query1);

    $query2 = "update appointmenttb set payment='$status' where contact='$contact';";
    $result2 = mysqli_query($con2, $query2);

    if ($result1 || $result2) {
        header("Location:updated.php");
    }
}

// Function to display doctors
function display_docs()
{
    global $con1, $con2;
    $query1 = "select * from doctb";
    $result1 = mysqli_query($con1, $query1);

    $query2 = "select * from doctb";
    $result2 = mysqli_query($con2, $query2);

    while ($row = mysqli_fetch_array($result1)) {
        $name = $row['name'];
        echo '<option value="'.$name.'">'.$name.'</option>';
    }

    while ($row = mysqli_fetch_array($result2)) {
        $name = $row['name'];
        echo '<option value="'.$name.'">'.$name.'</option>';
    }
}

// Handle addition of doctors
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];

    $query1 = "insert into doctb(name) values ('$name')";
    $result1 = mysqli_query($con1, $query1);

    $query2 = "insert into doctb(name) values ('$name')";
    $result2 = mysqli_query($con2, $query2);

    if ($result1 || $result2) {
        header("Location:adddoc.php");
    }
}

// Close connections
mysqli_close($con1);
mysqli_close($con2);
?>
