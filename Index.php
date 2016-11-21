<<?php //Created By Adam Hussain ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Catalog </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="page-header">
        <h1 class="centered-text">Home Catalog </h1>
        <div class="btn-group btn-group-justified">
          <a href="Add.php" class="btn btn-primary">Add</a>
          <a href="Search.php" class="btn btn-info">Search</a>

        </div>
      </div>



      <div class="row">
        </div>
        <div class="col-sm-1" id="home"></div>
        <div class="col-sm-10" id="home">
        <?php
          //Enter Server Connection Here
          $server = '';
          $user = '';
          $pass = '';
          $db = '';
          $index = 1;
          $conn = new mysqli($server,$user,$pass,$db);
          if($conn->connect_error)
          	die("Unable to connect");
          $query = "SELECT * FROM `home` ORDER BY `Name`";
          $result = $conn->query($query);
          if($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
            {
              echo  "<a href=\"info.php?Name=" . $row["Name"] ."\">" . "<img src= ".$row["Img"] . " class=\"img-rounded \" alt=" . $row["Name"] ." style=\" width:188px ;height:275px; padding-bottom:10px; padding-right:5px;\"></a>";
              $index = $index + 1;
            }
          }
          $conn->close(); //Make sure to close out the database connection
          ?>
        </div>
        <div class="col-sm-1" id="home"></div>
  </body>
</html>
