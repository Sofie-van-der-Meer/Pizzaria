<?php
declare(strict_types=1);
include("Presentation/header.php");
?>
<style>
    body {
        display: block;
    }
    form {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        max-width: 10em;
        max-height: 47vh;
        column-gap: 2em;
    }
</style>
<h1>Registreren</h1>
<?php
print $echo;
if (!isset($_SESSION["gebruiker"])) {
    ?>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="txtVoornaam">Voornaam:</label>
        <input type="text" name="txtVoornaam" id="txtVoornaam" required><br>
        <label for="txtAchternaam">Achternaam:</label>
        <input type="text" name="txtAchternaam" id="txtAchternaam" required><br>
        <label for="txtStraatnaam">Straatnaam:</label>
        <input type="text" name="txtStraatnaam" id="txtStraatnaam" required><br>
        <label for="txtHuisnummer">Huisnummer:</label>
        <input type="text" name="txtHuisnummer" id="txtHuisnummer" required><br>
        <label for="txtBus">Bus:</label>
        <input type="text" name="txtBus" id="txtBus"><br>
        <label for="idPlaats">Plaats:</label>
        <select name="idPlaats" id="idPlaats" required>
            <option value="">&numsp;---&numsp;Kies een optie&numsp;---&nbsp;</option>
            <?php foreach ($plaatsLijst as $plaats) { ?>
                <option value="<?= $plaats->getId(); ?>"><?= $plaats->getPlaatsNaam(); ?></option>
            <?php } ?>
        </select>
        <small>We leveren alleen in de opgegeven gemeenten!</small>
        <label for="nrTelefoonnummer">Telefoonnummer:</label>
        <input type="tel" name="nrTelefoonnummer" id="nrTelefoonnummer" placeholder="0423/123456 of 012/123456" pattern="[0-9]{3,4}/[0-9]{6}" minlength="10" maxlength="11" required><br>
        <label for="txtEmail">E-mailadres:</label>
        <input type="email" name="txtEmail"><br>
        <label for="txtWachtwoord">Wachtwoord: </label>
        <input type="password" name="txtWachtwoord"><br>
        <label for="txtWachtwoordHerhaal">Herhaal wachtwoord: </label>
        <input type="password" name="txtWachtwoordHerhaal"><br><br>
        <input type="submit" value="Inloggen" name="btnRegistreer">
    </form>
    <?php 
}
include("Presentation/footer.php");
?>