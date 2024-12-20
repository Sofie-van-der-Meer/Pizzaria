<?php
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Presentation/style.css">
    <meta charset="UTF-8">
    <title>Gebruikerstoegang</title>
</head>
<body>
    <header>
        <h1>Pizzaria De Leemoven</h1>
        <nav>
            <a href="index.php">Home</a> -
            <?php
            if (!isset($_SESSION["gebruiker"])) 
            {
                ?>
                <a href="login.php">Login</a> -
                <a href="register.php">Registreren</a>        
                <?php
            } else 
            {
                ?>
                <a href="logout.php">Logout</a>       
                <?php
            }
            if (!empty($_SESSION["card"]))
            {
                ?>
                - 
                <a href="afrekenen.php">Afrekenen</a>    
                <?php
            }
            ?>
        </nav>

                
    </header>



