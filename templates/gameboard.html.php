<?php

$player = $_SESSION['player'];

?>

<h1>Gamebaord</h1>

<h2>Aktuell an der Reihe: <img src="/icon.php?icon=<?=strtolower($player)?>" alt="aktueller Spieler"></h2>

<h3>Zufallszahl</h3>
<p><?=rand(1,1000)?></p>
<table>
    <?php for($y = 1; $y <= 3; $y++): ?>
        <tr> <!-- Zeile /-->
            <?php for($x = 1; $x <= 3; $x++): ?>
                <td><!-- Spalte /-->
                        <?php

                        $found = false;

                        foreach($_SESSION['played_fields'] as $field) {
                            if($x == $field['x'] and $y == $field['y']) {
                                echo '<img src="/icon.php?icon=' . strtolower($field['player']) . '" alt="'.$field['player'].'">';
                                $found = true;
                                break;
                            }
                        }

                        if(!$found) {
                            //echo sprintf('<a href="/?x=%s&y=%s">Spielen</a>',$x,$y);    // Das gleiche
                            echo '<a href="/?x='.$x.'&y='.$y.'"><img src="/icon.php" alt="Spielen"></a>';                 // wie das hier
                            //echo "<a href=\"/?x=$x&y=$y\">Spielen</a>";                 // wie das hier
                        }

                        ?>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

<a href="/?reset">Neustart</a>

<pre>
    <code>
        <?=print_r($_SESSION)?>
    </code>
</pre>

