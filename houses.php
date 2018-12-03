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

require("connect.php");

// $query = 'SELECT * FROM house';
// $statement = $db->prepare($query); 
// $statement->execute(); 
// $myHouse= $statement->fetchAll();

    $select_query = '';
    $statement = '';
    $rowperpage = 5;
    $row = 0;
    $enablePageLink = "none";
    if (isset($_GET['searchResult'])) {
        // Previous Button
        if(isset($_POST['but_prev'])){
            $row = $_POST['row'];
            $row -= $rowperpage;
            if( $row < 0 ){
                $row = 0;
            }
        }

        // Next Button
        if(isset($_POST['but_next'])){
            $row = $_POST['row'];
            $allcount = $_POST['allcount'];
            $val = $row + $rowperpage;
            if( $val < $allcount ){
                $row = $val;
            }
        }

        $searchString = "%" . filter_input(INPUT_GET, 'searchResult', FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "%";
        
        $count_query = "SELECT COUNT(*) AS rowCount FROM house WHERE HouseName LIKE :search OR Description LIKE :search";
        $statement = $db->prepare($count_query);
        $statement->bindValue(':search', $searchString);      
        $statement->execute();
        $myHouse = $statement->fetch();
        $allcount = $myHouse['rowCount'];
        
        $enablePageLink = ($allcount > 5)? "inline-block" : "none";
        $select_query = "SELECT * FROM house WHERE HouseName LIKE :search OR Description LIKE :search LIMIT $row,".$rowperpage;
        $statement = $db->prepare($select_query);
        $statement->bindValue(':search', $searchString);
    }
    else{
        $select_query = 'SELECT * FROM house';
        $statement = $db->prepare($select_query);
    }
    $statement->execute();
    $myHouse = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>All_Houses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <script src="main.js"></script>
</head>
<body>
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
   
   <div id = houseback> 
   <form class="nav navbar-nav" method=post action="searchProcess.php">
                    <ul style="list-style-type:none">
                        <li><input name="search_text" id="search_text" style="color:black" placeholder="search house"></li>
                        <li><input type="submit" name="search" style="color:black" value="Search" /></li>
                    </ul>
                </form>
    <a id="createHouse" href="createHouse.php">Create New House</a>
    <?php foreach($myHouse as $currentHouse): ?>
        <h2 class= "houseNameHeading"><a href="show.php?houseId=<?= $currentHouse['houseId']?>&slug=<?=$currentHouse['Slug']?>"><?= $currentHouse['HouseName']?></a></h2>
            <?php if(strlen($currentHouse['Description']) > 0): ?>
            <p>
                <?= substr($currentHouse['Description'], 0, 151)?>... <a href="show.php?houseId=<?= $currentHouse['houseId'] ?>">show</a>
            </p>
            <?php endif ?>
        <?php endforeach ?>

        <form method="post" action="#" style="display:<?=$enablePageLink?>">
            <div id="div_pagination" style="color:black">
                <input type="hidden" name="row" value="<?php echo $row; ?>">
                <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                <input type="submit" class="button" name="but_prev" value="Previous">
                <input type="submit" class="button" name="but_next" value="Next">
            </div>
        </form>
   </div>

</body>
</html>