<?php
// require('authenticate.php');

session_start();
    require('connect.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }

$id = filter_input(INPUT_GET, 'houseIdd', FILTER_SANITIZE_NUMBER_INT);
// Build a query using ":id" as a placeholder parameter.
$query = "SELECT * FROM house WHERE houseId = :houseId";
$statement = $db->prepare($query);

// Bind the :id parameter in the query to the previously
// sanitized $id specifying a type of INT.
$statement->bindValue(':houseId', $id, PDO::PARAM_INT);
$statement->execute(); 
$housee = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

    <nav>
        <a href="Index.php"><img src="o.png" alt="GOT"></a>
        <ul>
            <Li><a href="index.php">About</a></Li>
            <li><a href="houses.php">House</a></li>
        </ul>
    </nav>

<div class="container">
  <h2>House Creation form</h2>
  
  <form class="form-horizontal" action="processpost.php" method='post' enctype='multipart/form-data'>
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">House Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="text" placeholder="Enter houseName" name="houseName" value="<?= $housee['HouseName']?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" placeholder="Enter Description" name="description"><?= $housee['Description'] ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">Slug:</label>
      <div class="col-sm-10">          
      <input type="text" class="form-control" id="text" placeholder="Enter slug" name="slug" value="<?= $housee['Slug']?>">
    </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden"  name="houseId" value="<?=$housee['houseId']?>" />
        <input type="submit" name = "command" value="Edit" class="btn btn-default" />
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" name = "command" value="Delete" class="btn btn-default" />
      </div>
    </div>
  </form>
</div>

</body>
</html>
