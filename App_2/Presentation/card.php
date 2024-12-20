<article id="card">
    <h2>Winkelmandje</h2>
        <h4><a href="verwijderen.php?all=card">Leegmaken</a></h4>
    <ul>
    <?php
        $total = 0;
        foreach ($card as $row) {
            $pizza = $pizzaService->getPizzaById($row);
            $index = array_search($row, $card);
            ?>
        <li>
            <div>
                <h4>
                    <?= $pizza->getPizzaNaam();?>
                </h4>
                <p>
                    <?php // subtotaal
                        $subtotal = 0;
                        if (!isset($qty))
                        {
                            $subtotal = $pizza->getPrijs();
                        } else
                        {
                            $subtotal = $qty[$index] * $pizza->getPrijs();
                        }
                        $total += $subtotal;
                        echo number_format($subtotal, 2, ',');
                    ?> &euro;
                </p>
            </div>
            <div>
                <p>
                    <?= number_format($pizza->getPrijs(), 2, ',') ;?> &euro;
                </p>
                <div>
                    <a class="icon" href="verwijderen.php?id=<?= $pizza->getId(); ?>&index=<?= $index; ?>"> - </a>
                    &emsp;
                    <p>
                        <?php // hoeveelheid
                            if (!isset($qty))
                            {
                                echo 1;
                            } else
                            {
                                echo $qty[$index];
                            }
                        ?>
                    </p>
                    &emsp;
                    <a class="icon" href="toevoegen.php?id=<?= $pizza->getId(); ?>&index=<?= $index; ?>"> + </a>                    
                </div>
            </div>
        </li>
        <?php
        }
        ?>
    </ul>
    <h4>Totaal: <?= number_format($total, 2, ','); ?> &euro;</h4>
    <?php if (htmlentities($_SERVER["PHP_SELF"]) !== "/pizzaria/App_2/afrekenen.php") {
        ?>
            <h3><a href="afrekenen.php">Bestellen - <?= number_format($total, 2, ','); ?> &euro;</a></h3>
        <?php
        };  ?>
    <h4><a href="verwijderen.php?all=card">Leegmaken</a></h4>
</article>
