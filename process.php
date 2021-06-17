<?php
session_start();
$mysqli = new mysqli('localhost:3306','root','','crud') or die(mysqli_error($mysqli));
$id=0;
$update=false;
$name='';
$city='';

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $mysqli->query("INSERT INTO data(name, city) VALUES('$name','$city')") or die($mysqli->error);

    $_SESSION['message']="Record saved successfully.";
    $_SESSION['msgtype']="success";
 
    header("location:index.php");
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message']="Record deleted successfully.";
    $_SESSION['msgtype']="danger";

    header("location:index.php");
}

if (isset($_GET['edit']))
{
	$id = $_GET['edit'];	
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
	$row = $result->fetch_array();
	$name = $row['name'];
	$city = $row['city'];
}

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $city=$_POST['city'];
    $mysqli->query("UPDATE data SET name='$name', city='$city' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message']="Record updated successfully.";
    $_SESSION['msgtype']="warning";

    header("location:index.php");
}

?>