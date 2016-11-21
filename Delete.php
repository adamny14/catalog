<<?php //Created By Adam Hussain ?>

<?php

// Enter the server connection details here
$server = '';
$user = '';
$pass = '';
$db = '';
$entered = false;

$conn = new mysqli($server,$user,$pass,$db);

if($conn->connect_error)
  die("Unable to connect");
if(isset($_GET['ID']))
{
  $ID = $_GET["ID"];
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // sql to delete a record
  $sql = "DELETE FROM `home` WHERE `ID`=$ID";
  $conn->query($sql);
  mysqli_close($conn);
  header("Location: http://localhost/catalog/Index.php");
  die();
}

?>
