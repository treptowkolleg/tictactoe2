<?php

$player = $_SESSION['player'];

?>

<h1>Gamebaord</h1>

<h2>Aktuell an der Reihe: <?=$player?></h2>

<table>
    <?php for($y = 1; $y <= 3; $y++): ?>
        <tr> <!-- Zeile /-->
            <?php for($x = 1; $x <= 3; $x++): ?>
                <td><!-- Spalte /-->
                    <a href="<?= "/?x=$x&y=$y" ?>"><!-- Link /-->
                        Spielen<!-- Linktext /-->
                    </a>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

