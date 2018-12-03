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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
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
   <div>
        <p id = "brief">Game of Thrones takes place on the fictional continents of Westeros and Essos in a setting that very much resembles the Middle Ages of Earth — though, as in many fantasy novels, there’s no specific correlation to Earth history. While the story contains common fantasy elements, such as swordplay, magic, and fantastical creatures like dragons, those elements are downplayed in favor of political intrigue and human drama.

The show depicts the three core storylines of the book series. The first is the continuing civil war between the various houses of Westeros, each vying for the Iron Throne and control of the Seven Kingdoms of Westeros — hence, the name Game of Thrones. The three principle houses involved in this civil war are the Starks of Winterfell, the Lannisters of Casterly Rock, and the Baratheons of Dragonstone. At the start of the series, the Baratheons control the Iron Throne. However, with the death of King Robert Baratheon, the Lannisters seize power when Robert’s wife Cersei Lannister becomes queen-regent after her son assumes the throne; Cersei’s brother, Tyrion Lannister, becomes their chief advisor. After that, many of the other houses rise up to fight Lannister control and claim their own right to the Iron Throne.

The second storyline takes place in Essos, a harsh land of mostly desert. Daenerys Targaryen, the exiled daughter and last surviving heir to House Targaryen (which used to rule the Seven Kingdoms before the Baratheons came to power), seeks to build an army and return to Westeros to reclaim the Iron Throne. At first sold into marriage to the Dothraki tribal leader Khal Drogo by her older brother (who was later killed), Daenerys has become a powerful queen and has in her possession three dragons — a species thought instinct since the rule of the Targaryens. With her dragons and the massive army she’s building, Daenerys plans to cross the Narrow Sea, which separates the two continents, and defeat those who deposed and killed her father.

The third storyline takes place in the Northern part of Westeros at the massive ice structure called the Wall, which protects the southern lands from the “wildling” humans and supernatural creatures (such as White Walkers) that live “beyond the Wall.” Jon Snow, the illegitimate son of Ned Stark (head of House Stark) enlists with the Night’s Watch, the small army stationed at the Wall that is charged with protecting the southern lands. With the approach of a long winter, the Wall and the Night’s Watch are under siege from wildling invaders who seek to overtake the Seven Kingdoms. What’s happening at the Wall is mostly unknown to the rest of Westeros, and the peoples of the Seven Kingdoms are unprepared for the coming threat.</p>
   </div>
   
</body>
</html>