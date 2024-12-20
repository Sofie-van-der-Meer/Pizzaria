<?php 
declare(strict_types=1);

session_start();
unset($_SESSION["gebruiker"]);

spl_autoload_register();
header('location: index.php');
?>