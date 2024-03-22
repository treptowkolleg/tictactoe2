<h1>Gamebaord</h1>

<table>
    <?php for($i = 1; $i <= 3; $i++): ?>
        <tr> <!-- Zeile /-->
            <?php for($k = 1; $k <= 3; $k++): ?>
                <td><?= "$i $k" ?></td><!-- Spalte /-->
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

