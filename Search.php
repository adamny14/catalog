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

        </div>
      </div>



      <div class="row">
        <div class ="col-sm-2">
          <form action = "Search.php" method ="post">
            <label for="Name">Enter What You Want To Search: </label>
            <input type = "search" class="form-control" name="Name">
            <input type = "submit" value="Submit">

        </div>
        <div class="col-xs-10">

          <?php
            $server = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'catalog';
            $conn = new mysqli($server,$user,$pass,$db);
            // Check connection
            if($conn->connect_error)
            	die("Unable to connect");
            if(isset($_POST['Name']))
            {
                $v1 = $_POST['Name'];
                $query = "SELECT * FROM `home` WHERE `Name` LIKE '%$v1%';";
                $query2 = "SELECT * FROM `home` WHERE `Type` LIKE '%$v1%';";
                $query3 = "SELECT * FROM `home` WHERE `Location` LIKE '%$v1%';";





                $result1 = $conn->query($query);
                $result2 = $conn->query($query2);
                $result3 = $conn->query($query3);

                if ( $result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) { echo"<h1> 0 Results Found</h1>";}
                else
                  {

                    if($result1->num_rows > 0 || $result2->num_rows > 0 || $result3->num_rows > 0)
                    {
                      // out put each row
                      echo "<h1>Name:</h1>";

                      echo "<a href=\"catalog.php?Name=" . $_POST["Name"]. "\" class=\"btn btn-primary\">Print out Names</a>";
                      echo "<div class=\"page-header\">";
                      while($row = $result1->fetch_assoc())
                      {
                        echo  "<a href=\"info.php?Name=" . $row["Name"] ."\">" . "<img src= ".$row["Img"] . " alt=" . $row["Name"] ." style=\" width:188px ;height:275px; padding-bottom:10px; padding-right:5px;\"></a>";
                      }
                      if($result1->num_rows == 0)
                        echo "<h2>No Results With Similar Name</h2>";
                      echo "</div>";
                      echo "<h1>Type:</h1>";
                      echo "<div class=\"page-header\">";
                      while($row1 = $result2->fetch_assoc())
                      {
                        echo  "<a href=\"info.php?Name=" . $row1["Name"] ."\">" . "<img src= ".$row1["Img"] . " alt=" . $row1["Name"] ." style=\" width:188px ;height:275px; padding-bottom:10px; padding-right:5px;\"></a>";
                      }
                      echo "</div>";
                      echo "<h1>Location:</h1>";
                      echo "<div class=\"page-header\">";
                      while($row2 = $result3->fetch_assoc())
                      {
                        echo  "<a href=\"info.php?Name=" . $row2["Name"] ."\">" . "<img src= ".$row2["Img"] . " alt=" . $row2["Name"] ." style=\" width:188px ;height:275px; padding-bottom:10px; padding-right:5px;\"></a>";
                      }
                      echo "</div>";

                    }
                  }
                }

            mysqli_close($conn);
          ?>


        </div>
      </div>
  </body>
</html>
