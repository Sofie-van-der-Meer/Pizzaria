<?php
declare(strict_types=1);
include("Presentation/Header.php");
?>
<style>
    body {
        display: block;
    }
    div>a {
        background-color: buttonface;
        padding: 0.1em 0.3em;
        border: 1px buttonborder solid;
        border-radius: 0.1em;
        margin: 1em 0;
    }
</style>
<h1>Inloggen</h1>
<?php
print $echo;
if (!isset($_SESSION["gebruiker"])) {
    ?>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        E-mailadres: <input type="email" name="txtEmail"><br>
        Wachtwoord: <input type="password" name="txtWachtwoord"><br>
        <input type="submit" value="Inloggen" name="btnLogin">
    </form>
    <?php
} ?>
<div class="flex">
    <p>Nog geen account?</p>
    &emsp;
    <a href="register.php">Maak nu een aan!</a>    
</div>

<?php
include("Presentation/Footer.php");
?>