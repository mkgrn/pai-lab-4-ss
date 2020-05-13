<?php if (!$this) die(); ?>
<div id="searchResultsDiv">
    <?php if ($komunikat) : ?>
        <p class="komunikat"><?= $komunikat ?></p>
    <?php else : ?>
        <table>
            <tr>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Wydawnictwo</th>
                <th>Cena</th>
                <th>Koszyk</th>
            </tr>
            <!-- Pętla odczytująca wyniki -->
            <?php while ($row = $result->fetch_row()) : ?>
                <tr>
                    <?php $count = count($row); ?>
                    <!--Komórka z tytułem -->
                    <td>
                        <a href="index.php?action=showBookDetails&amp;id=
<?= $row[$count - 1] ?>"><?= $row[0] ?></a>
                    </td>
                    <!-- Pętla odczytująca kolumny wynikowe -->
                    <?php for ($i = 1; $i < $count - 1; $i++) : ?>
                        <td><?= $row[$i] ?></td>
                    <?php endfor; ?>
                    <!-- Komórka z odnośnikiem do koszyka -->
                    <td>
                        <a href="index.php?action=addToBasket&amp;id=
<?= $row[$count - 1] ?>">Dodaj</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</div>