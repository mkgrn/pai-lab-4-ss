<?php
class Basket {
private $dbo = null;
function __construct($dbo) {
$this->dbo = $dbo;
//Utworzenie koszyka, jesli koniczne
if (!isset($_SESSION['basket'])) {
$_SESSION['basket'] = array();
}
}
function add() {
    // Sprawdzenie poprawności parametru id
    if (!isset($_GET['id'])) {
    return FORM_DATA_MISSING;
    }
    if (($id = (int) $_GET['id']) < 1) {
    return INVALID_ID;
    }
    // Sprawdzenie, czy istnieje książka o podanym id
    $query = "SELECT Cena FROM ksiazki WHERE id=$id";
    if (($cena = $this->dbo->getQuerySingleResult($query)) === false) {
    return INVALID_ID;
    }
    // Zapisanie identyfikatora książki w koszyku
    if (isset($_SESSION['basket'][$id])) {
    $_SESSION['basket'][$id]->ile++;
    $_SESSION['basket'][$id]->cena = $cena;
    } else {
    $_SESSION['basket'][$id] = new BasketItem($id, $cena, 1);
    }
    return ACTION_OK;
    }
function show($title, $allowModify = true) {
}
function modify() {
}
function saveOrder(&$orderId) {
}
} ?>