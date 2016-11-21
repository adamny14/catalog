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
        <div class ="col-sm-4">

        </div>
        <div class = "col-sm-4">

          <div class="form-group">
            <?php
              $server = 'localhost';
              $user = 'root';
              $pass = '';
              $db = 'catalog';
              $conn = new mysqli($server,$user,$pass,$db);
              if($conn->connect_error)
              	die("Unable to connect");
                if(isset($_GET['ID'])){
                    $v1 = $_GET['ID'];
                $v1 = mysqli_real_escape_string($conn, $v1);

              $query = "SELECT * FROM `home` where ID =". $v1;
              $result = $conn->query($query);

             if($result->num_rows > 0)
            {
                // out put each row
                while($row = $result->fetch_assoc())
               {
                #  echo "<b>#</b> " .$row["ID"] . " " ."<b>Name</b>: " .$row["Name"] . " ";
              #    echo "<b>Location: </b>" .$row["Location"]. " ". "<b>Type: </b>" .$row["Type"]. " ";
              #    echo "<b>Quantity: </b>". $row["Quantity"] . " ". "<b>ISBN/SKU# </b>" . $row["ISBN"] . "<br></br> ";

              ?>
              <form action = "Update.php" method ="post">

                <label for="Name">What the Name of The Object:</label>
                <input type = "text" required pattern=".+" class="form-control" value = <?php echo "\"" .$row["Name"] ."\"";  ?>name="Name">
                <label for="Location">What the Location of the Object:</label>
                <input type = "text" required pattern = ".+" class="form-control" name="Location" value = <?php echo "\"" . $row["Location"] ."\"";  ?>>
                <label for="Type">What Type is the Object (i.e. Book, Movie):</label>
                <input type = "text" required pattern = ".+" class="form-control" name="Type" value = <?php echo  "\"" . $row["Type"] ."\"";  ?> >
                <label for="Quantity">Quantity of the object:</label>
                <input type = "text" required pattern = "\d+" class="form-control" name="Quantity" value = <?php echo "\"" . $row["Quantity"] ."\"";  ?> >
                <label for="ISBN">ISBN/SKU# for Object:</label>
                <input type = "text" required pattern = "\d+" class="form-control" name="ISBN" value = <?php echo "\"" . $row["ISBN"] ."\"";  ?>>
                <label for="Author">Author (Leave Blank If N/A)</label>
                <input type = "text"  pattern = ".+" class="form-control" name="Author" value = <?php echo "\"" . $row["Author"] ."\"";  ?> >
                <label for="Img">Name Image For The Item: </label>
                <input type = "text" required pattern = ".+" class="form-control" name="Img" value =
                <?php if(preg_match('~.+/(.+)\.~', $row["Img"], $matches))
                      { echo "\"" .$matches[1]. "\"";}
                      else { echo "\"\"";}  ?>>
                <input type="hidden" name="ID" value=<?php echo "\"".$v1 ."\"" ?>>
                <input type = "submit" value = "Submit">
                <?php
              }
            }
          }
            $conn->close(); //Make sure to close out the database connection
                 ?>
          </div>
        </div>
        <div class="col-xs-10">


        </div>
      </div>
  </body>
</html>

<?php

	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'catalog';
  $entered = false;

	$conn = new mysqli($server,$user,$pass,$db);

	if($conn->connect_error)
		die("Unable to connect");
if(isset($_POST['Name']))
{
    $ID = $_POST["ID"];
    $v11 = addslashes($_POST['Name']);
  	$v2 = addslashes($_POST["Location"]);
  	$v3 = addslashes($_POST['Type']);
  	$v4 = addslashes($_POST['Quantity']);
  	$v5 = addslashes($_POST['ISBN']);
    $v6 = addslashes($_POST['Author']);
    $v7 = addslashes($_POST['Img']);
    if($_POST['Author'] == "")
      $sql = "UPDATE `home` SET `Name`='$v11', `Location`='$v2', `Type`='$v3', `Quantity`='$v4', `ISBN`='$v5',`Img`='Photos/$v7.jpg' WHERE `ID` =". $ID ;
    else
  	 $sql = "UPDATE `home` SET `Name`='$v11', `Location`='$v2', `Type`='$v3', `Quantity`='$v4', `ISBN`='$v5',`Author`='$v6', `Img`='Photos/$v7.jpg' WHERE `ID` =".$ID;
  	$conn->query($sql);
  $entered = true;


  	$conn->close();
    header("Location: http://localhost/catalog/Update.php?ID=$ID");
    die();

}

?>
