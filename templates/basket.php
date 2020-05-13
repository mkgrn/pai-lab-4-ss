<?php if (!$this) die(); ?> 
<div id="basketDiv"> <?php if ($komunikat){ ?> 
    <div class="komunikat"><?= $komunikat ?></div> 
<?php } else { ?> 
    <form action="index.php?action=modifyBasket" method="post"> 
        <table> <!-- Dany wiersz tabeli z tytulem --> 
        <tr><td colspan="4" class="textMiddle"><Zphp Stine ?></td></tr> 
        <tr><!-- Nagłówki kolumn --> 
        <th>Tytul</th> 
        <th class="textRight">Cena</th> <th class="textRight">Liczba</th> 
        <th class="textRight">Warto66</th> </tr> 
        <!-- Tutaj petla while odczytujaca listę książek --> 
        <?php 
$suma = 0;
while($row = $books->fetch_row()) { ?>
 <tr> 
     <td class="textLeft"><?= $row[1] ?></td> 
     <td class="textRight"><?= $basket[$row[0]]->cena ?></td>
      <?php 
      // Liczba egzemplarzy i wartość dla danej książki 
      $ile = $basket[$row[0]]->ile; 
      $wartosc = $ile * $basket[$row[0]]->cena; 
      $wartosc = sprintf("%01.2f", $wartosc); 
      // Sumowanie całkowitej wartości koszyka 
      $suma += $wartosc; 
      ?> 
      <td class="textRight">
       <?php if($allowModify){ ?> 
        <!-- Jeżeli dopuszczamy modyfikacje liczby egzemplarzy -->
        <input type="text" name="<?= $basket[$row[0]]->id ?>"value="<?= $ile ?>" size="2" class="textRight">
        <?php
     }else{  ?>
            <!-- Jeżeli podsumowujemy zamowienie --> 
            <?= $ile ?> 
            <?php } ?> 
        </td> 
        <td class="textRight"><?= $wartosc ?></td> 
    </tr> 
    <?php } ?>
        <tr> 
            <td colspan="3">Calkowita warto66</td>
            <!-- Formatowanie sumy zamówienia --> 
            <td class="textRight"><?php sprintf("%01.2f", $suma) ?></td>
         </tr> <?php if ($allowMadify){ ?> 
            <tr><td colspan="4" class="textRight"><input type="submit" value="Zapisz zmiany"></td></tr> 
         <?php } ?> 
         <tr> <td colspan="4" class="textRight">
              <?php if ($allowModify){ ?><a href="index.php?action=checkout">Do kasy</a> 
                <?php }
                else{ ?><a href="index.php?action=saveOrder">Złóż zamowienie</a><?php } ?> 

                </td> 
            </tr> 
        </table> 
        <?php } ?> 
              </div>