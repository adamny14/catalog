<<?php //Created By Adam Hussain ?>
<!DOCTYPE html>
<hmtl>
  <head>
    <title>Add an Item </title>
    <link rel="shortcut icon" href = "home.ico">
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
            <a href="Search.php" class="btn btn-danger">Search</a>

          </div>

      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class = "centered-text">Enter Items</p>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
              <form action = "Add.php" method ="post">

                <label for="Name">What the Name of The Object:</label>
                <input type = "Type" required pattern=".+" class="form-control" name="Name">
                <label for="Location">What the Location of the Object:</label>
                <input type = "Location" required pattern = ".+" class="form-control" name="Location">
                <label for="Type">What Type is the Object (i.e. Book, Movie):</label>
                <input type = "Type" required pattern = ".+" class="form-control" name="Type">
                <label for="Quantity">Quantity of the object:</label>
                <input type = "text" required pattern = "\d+" class="form-control" name="Quantity">
                <label for="ISBN">ISBN/SKU# for Object:</label>
                <input type = "text" required pattern = "\d+" class="form-control" name="ISBN">
                <label for="Author">Author (Leave Blank If N/A)</label>
                <input type = "text"  pattern = ".+" class="form-control" name="Author">
                <label for="Img">Name Image For The Item: </label>
                <input type = "text" required pattern = ".+" class="form-control" name="Img">
                <input type = "submit" value = "Submit">
          </div>
          </div>
          <div class="col-sm-3">
          </div>

      </div>
  </body>
</html>

<?php

  //enter your sever connection here
	$server = '';
	$user = '';
	$pass = '';
	$db = '';
  $entered = false;

	$conn = new mysqli($server,$user,$pass,$db);

	if($conn->connect_error)
		die("Unable to connect");
if(isset($_POST['Name']))
{
    $v1 = addslashes($_POST['Name']);
  	$v2 = addslashes($_POST["Location"]);
  	$v3 = addslashes($_POST['Type']);
  	$v4 = addslashes($_POST['Quantity']);
  	$v5 = addslashes($_POST['ISBN']);
    $v6 = addslashes($_POST['Author']);
    $v7 = addslashes($_POST['Img']);
    if($_POST['Author'] == "")
      $sql = "INSERT INTO `home`(`Name`, `Location`, `Type`, `Quantity`, `ISBN`,`Img`) VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', 'Photos/$v7.jpg')";
    else
    //Note: Photos must have a .jpg file type to be displayed. If you want to change you must adjust the code accordingly
  	 $sql = "INSERT INTO `home`(`Name`, `Location`, `Type`, `Quantity`, `ISBN`,`Author`, `Img`) VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', '$v6', 'Photos/$v7.jpg')";
  	$conn->query($sql);
  $entered = true;


  	$conn->close();


}

?>
