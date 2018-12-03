<?php

    session_start(); 

    /*if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }*/
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }

    require 'connect.php';

    // Sanitize $_GET['id'] to ensure it's a number.
    $houseId = filter_input(INPUT_GET, 'houseId', FILTER_SANITIZE_NUMBER_INT);

    // Build a query using ":id" as a placeholder parameter.
    $query = "SELECT * FROM house WHERE houseId = :houseId";
    $statement = $db->prepare($query);
    $statement->bindValue(':houseId', $houseId, PDO::PARAM_INT);
    $statement->execute(); 
    $housee = $statement->fetch();

    $characterQuery = "SELECT `CharacterId`, `CharacterName`, `CharacterDescription`, `Image`, `HouseId` FROM `character`  WHERE HouseId = :houseId";
    $statemente = $db->prepare($characterQuery);
    $statemente->bindValue(':houseId', $houseId, PDO::PARAM_INT);
    $statemente->execute();  
    $character = $statemente->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show House</title>
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <script src="test.js"></script>
</head>
<body style = "background-image: url('back.jpg');
	background-attachment: fixed;background-position: center;">
    <div id="wrapper">
        <div id="header">
            <nav>
                <a href="Index.php"><img src="o.png" alt="GOT"></a>
                <ul>
                    <Li><a href="index.php">About</a></Li>
                    <li><a href="houses.php">House</a></li>
                    <?php  if (isset($_SESSION['username'])) : ?>
                        <li><a href="index.php">Welcome <strong><?=$_SESSION['username']?></strong>, <?=$_SESSION['success']?></a></li>
                        <li><a href="index.php?logout='1'" style="color: red;">logout</a></li>
                    <?php else: ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
        <div>
            <h1><?=$housee['HouseName']?></h1>
            <a href="createHouse.php" class = "linkk">Create New House</a>
            <a href="editHouse.php?houseIdd=<?= $housee['houseId']?>" class="linkk">Update House <?= $housee['HouseName'] ?></a>
          
            <p><?= $housee['houseId'] ?></p>  
            <h2><?=$housee['HouseName']?></h2>
            <p>
                <?= $housee['Description'] ?>
            </p>
            <img src="images/<?= $housee['BannerImage'] ?>.jpg" alt="image">
        </div>
    </div>

     <table id="sort">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Character Name <i class="NameUp"></i><i class="NameDown"></i></th>
                <th>Character Description</th>
                <th>Image</th>
                <th>Edit</th>
            </tr>
        </thead>
        <?php foreach($character as $char): ?>
        <tbody>
            <tr>
                <td><?= $char['CharacterName']?></td>
                <td><?= $char['CharacterDescription']?></td>
                <td><img src="<?= $char['Image']?>" alt="nejej"></td>
                <td>djfk</td>
            </tr>
        </tbody>
        <?php endforeach?>
    </table> 
    
</body>
</html>