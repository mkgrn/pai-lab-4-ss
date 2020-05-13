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
}
function show($title, $allowModify = true) {
}
function modify() {
}
function saveOrder(&$orderId) {
}
} ?>