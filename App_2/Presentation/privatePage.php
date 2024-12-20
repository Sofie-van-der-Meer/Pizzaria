<?php
declare(strict_types=1);
include("Presentation/header.php");
?>

<main>
    <h2>Bestelling afronden</h2>
    <h4>Controleer uw gegevens</h4>
    <div class="flex">
        <dl>
            <!-- <dt>Bestelling op naam van</dt>     -->
            <dd>
                <?= $gebruiker->getNaam();?>
            </dd>
            <!-- <dt>Leveringsadres</dt> -->
            <dd>
                <?= $gebruiker->getAdres();?>
            </dd>
            <!-- <dt>Contactnummer</dt> -->
            <dd>
                <?= $gebruiker->getTelefoonnummer();?>
            </dd><br> 
            <input type="checkbox" name="boxChangeKlantgegevens" id="boxChangeKlantgegevens">    
            <label for="boxChangeKlantgegevens" 
                id="label_boxChangeKlantgegevens" style="padding-right: 2em;">
                Mijn gegevens kloppen niet.
            </label>   
        </dl>
        <form id="formKlantgegevens" action="<?= htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST" hidden>
            <div>
                <label for="txtStraatnaam">Straatnaam:</label><br>
                <input type="text" name="txtStraatnaam" id="txtStraatnaam" 
                    value="<?= $gebruiker->getStraatnaam() ?>" required><br>
                <label for="txtHuisnummer">Nummer:</label><br>
                <input type="text" name="txtHuisnummer" id="txtHuisnummer" size="2"
                    value="<?= $gebruiker->getHuisnummer() ?>" required> <br>
                <label for="txtBus">Bus:</label><br>
                <input type="text" name="txtBus" id="txtBus" size="1" value="<?= $gebruiker->getBus() ?>"><br>
                <label for="idPlaats">Plaats:</label><br>
                <select name="idPlaats" id="idPlaats" required>
                    <option value="<?= $plaatsGebruiker->getId() ?>">
                        <?= $plaatsGebruiker->getPlaatsNaam() ?>
                    </option>
                    <?php foreach ($plaatsLijst as $plaats) { 
                        ?>
                        <option value="<?= $plaats->getId(); ?>"><?= $plaats->getPlaatsNaam(); ?></option>
                    <?php } ?>
                </select> <br>
            </div>
            <div>
            <label for="txtVoornaam">Voornaam:</label><br>
            <input type="text" name="txtVoornaam" id="txtVoornaam" size="10"
                value="<?= $gebruiker->getVoornaam() ?>" required><br>
            <label for="txtAchternaam">Achternaam:</label><br>
            <input type="text" name="txtAchternaam" id="txtAchternaam" size="10"
                value="<?= $gebruiker->getAchternaam() ?>" required><br>
            
            <label for="nrTelefoonnummer">Telefoonnummer:</label><br>
            <input type="tel" 
                name="nrTelefoonnummer" id="nrTelefoonnummer" size="10"
                value="<?= $gebruiker->getTelefoonnummer() ?>" 
                pattern="[0-9]{3,4}/[0-9]{6}" 
                minlength="10" maxlength="11" required><br><br>
            <input type="submit" name="changeKlantgegevens" id="changeKlantgegevens" value="Gegevens aanpassen">
            </div>
        </form>        
    </div>
    <br>
    <form action="<?= htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
        date_default_timezone_set('Europe/Brussels');
        $t = time();
        $nt = $t - ($t % 600) + 600;
        ?>
        <label for="extraTime">De bestelling laten leveren om:</label>
        <select name="extraTime" id="extraTime" required>
            <?php
            for ($i=0; $i < 8; $i++) { 
                $extraTime = (10 * $i) + 30;
                ?>
                    <option value="<?= $extraTime; ?>">
                        <?= date('H:i', (int) $nt + ($extraTime * 60)); ?>
                    </option>
                <?php                                        
            } ?>
        </select> <br><br>
        <label for="txtExtraInfo">Extra informatie voor de bezorger:</label><br>
        <textarea name="txtExtraInfo" id="txtExtraInfo" placeholder="Geef hier extra infomatie op over uw bestelling" rows="5" cols="40"></textarea> <br>
        <input type="submit" name="bestellingAfronden" id="bestellingAfronden" value="Bestelling plaatsen">
    </form>
</main>
<script>
    const style_formKG = 
    `   display: flex;
        gap: 2em;
        width: 50%;
    `;
    const formKG = document.getElementById('formKlantgegevens');
    document.getElementById('boxChangeKlantgegevens').onchange = function()
    {
        if (this.checked)
        {
            formKG.visible = this.checked;
            formKG.style.cssText = style_formKG;
        } else
        {
            formKG.hidden = !this.checked;
            formKG.style.cssText = ``;
        }
    }
</script>

<?php
include("Presentation/footer.php");
?>

