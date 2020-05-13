<?php if (!$this) die(); ?>
<div id="bookDetailsDiv">
    <?php if ($komunikat) : ?>
        <div class="komunikat"><?= $komunikat ?></div>
    <?php else : ?>
        <table>
            <tr>
                <td>Tytuł</td>
                <td><?= $row['Tytul'] ?></td>
                <td rowspan="7" class="textMiddle">
                    <a href="index.php?action=addToBasket&id=
<?= $row['Id'] ?>">Do koszyka</a>
                </td>
            </tr>
            <tr>
                <td>Autor</td>
                <td><?= $row['Autor'] ?></td>
            </tr>
            <tr>
                <td>ISBN</td>
                <td><?= $row['ISBN'] ?></td>
            </tr>
            <tr>
                <td>Wydawnictwo</td>
                <td><?= $row['Wydawnictwo'] ?></td>
            </tr>
            <tr>
                <td>Rok wydania</td>
                <td><?= $row['Rok'] ?></td>
            </tr>
            <tr>
                <td>Cena</td>
                <td><?= $row['Cena'] ?></td>
            </tr>
            <tr>
                <td>Opis</td>
                <td><?= $row['Opis'] ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>