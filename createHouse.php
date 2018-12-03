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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CreateHouse</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script> -->
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
        <input type="text" class="form-control" id="text" placeholder="Enter houseName" name="houseName">
      </div>
    </div>
    <form>
  <div class="form-group">
    <label for="image">Banner Image:</label>
     <input type="file" class="form-control-file" name="image" id="image">
  </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">Description:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">Slug:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="text" placeholder="Enter Slug" name="slug">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" name = "command" value="Create" class="btn btn-default" />
      </div>
    </div>
  </form>
</div>

</body>
</html>
