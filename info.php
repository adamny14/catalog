<!DOCTYPE html>
<hmtl>
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
          <a href="Index.php" class="btn btn-success">Catalog Home</a>
          <a href="Add.php" class="btn btn-primary">Add</a>
          <a href="Search.php" class="btn btn-info">Search</a>

        </div>
      </div>



      <div class="row">
        <?php
        //Enter Server connection here
          $server = '';
          $user = '';
          $pass = '';
          $db = '';
         $v1 = $_GET['Name'];
        $conn = new mysqli($server,$user,$pass,$db);
        $v2 = mysqli_real_escape_string($conn, $v1);

          if($conn->connect_error)
          	die("Unable to connect");

          if(isset($_GET['Name']))
          {
            $query = "SELECT * FROM `home` WHERE `Name` =\"$v2\" ";
            $result = $conn->query($query);

            if($result)
            {
              if($result->num_rows > 0)
              {
                // out put each row
                while($row = $result->fetch_assoc())
                {
                  ?>
                  <div class="col-md-4 hidden-xs hidden-sm">
                    <?php
                  echo "<img src= ".$row["Img"] . " class=\"img-rounded mainimg\" alt=" . $row["Name"] ." style=\"width:500px ;height:700px;\"> <br></br>";
                  echo "</div>";
                  ?>
                  <div class="col-sm-4 visible-xs visible-sm">
                    <?php
                  echo "<img src= ".$row["Img"] . " class=\"img-rounded mainimg\" alt=" . $row["Name"] ."align:\"middle\" style=\"width:250px ;height:320px;\"> <br></br>";
                  echo "</div>";
                  echo "<div class=\"col-xs-2\" > </div>";
                  echo  "<div class=\"col-xs-6\" id=\"home\">";
                  echo "<b>ID: </b>". $row["ID"] . "<b> Name: </b>" .$row["Name"] . "  ";
                  if($row["Author"] != NULL)
                    echo "<b>Author: </b>" .$row["Author"] ."<br></br>";
                  else {
                    echo "<br></br>";
                  }
                  echo "<b>Type: </b>" .$row["Type"] . " ". "<b>Location</b>: ". $row["Location"] . "<br></br>";
                  echo "<b>Quantity: </b>" .$row["Quantity"] . " " . "<b> ISBN/SKU: " . $row["ISBN"] . "<br></br>";
                  echo "<a href=\"Update.php?ID=".$row["ID"]. "\" class=\"btn btn-info\">Update</a>   ";
                  echo "<a href=\"Delete.php?ID=".$row["ID"]. "\" class=\"btn btn-danger\">Delete</a>";


                }
              }


            }
            $conn->close(); //Make sure to close out the database connection
          }
          ?>

        </div>
      </div>
  </body>
</html>
