<?php
declare(strict_types=1);
include("Presentation/Header.php");
?>
<main>
    <ul>
    <?php
    foreach ($pizzaLijst as $pizza) {
        $number = random_int(1, 900)
        ?>
        <li>
            <img src="../Static/pizza_<?= str_replace(" ", "_", $pizza->getPizzaNaam()); ?>.jpg"
             alt="pizza <?= $pizza->getPizzaNaam(); ?>">
            <h4><?= $pizza->getPizzaNaam(); ?></h4>
            <p><?= number_format($pizza->getPrijs(), 2, ','); ?> &euro;</p>
            <a class="icon" href="toevoegen.php?id=<?= $pizza->getId(); ?>">+</a>
        </li>
        <?php
    }
    ?>    
    </ul>    
</main>
<?php
include("Presentation/Footer.php");
?>