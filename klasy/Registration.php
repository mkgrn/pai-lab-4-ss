<?php
class Registration {
private $dbo = null;
private $fields = array();
function __construct($dbo) {
$this->dbo = $dbo;
$this->initFields();
}
function initFields() {
    $this->fields['email'] = new FormInput('email', 'Adres e-mail');
$this->fields['haslo'] = new FormInput('haslo', 'Hasło', '', 'password');
$this->fields['haslo2'] = new FormInput('haslo2', 'Powtórz hasło', '', 'password');
$this->fields['imie'] = new FormInput('imie', 'Imię');
$this->fields['nazwisko'] = new FormInput('nazwisko', 'Nazwisko');
$this->fields['ulica'] = new FormInput('ulica', 'Ulica');
$this->fields['nr_domu'] = new FormInput('nr_domu', 'Numer domu');
$this->fields['nr_mieszkania'] =
new FormInput('nr_mieszkania', 'Numer mieszkania', '', 'text', false);
$this->fields['miejscowosc'] = new FormInput('miejscowosc', 'Miejscowość');
$this->fields['kod'] = new FormInput('kod', 'Kod pocztowy');
$this->fields['kraj'] = new FormInput('kraj', 'Kraj');
}
function showRegistrationForm() {
   foreach ($this->fields as $name => $field) {
$field->value =
isset($_SESSION['formData'][$name]) ? $_SESSION['formData'][$name] : '';
}
$formData = $this->fields;
if (isset($_SESSION['formData'])) {
unset($_SESSION['formData']);
}
include 'templates/registrationForm.php';
}
function registerUser() {
    foreach ($this->fields as $name => $val) {
        
        if (!isset($_POST[$name])) {
        return FORM_DATA_MISSING;
        }
        // Tutaj lub po przefiltrowaniu dodatkowa weryfikacja danych,
        // w tym sprawdzenie długości ciągów, znaków niedozwolonych itp.
        // Odczyt i przefiltrowanie danych z formularza
        $fieldsFromForm = array();
        $emptyFieldDetected = false;
        foreach ($this->fields as $name => $val) {
        if ($val->type != 'password') {
        $fieldsFromForm[$name]
        = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
        $fieldsFromForm[$name] = $_POST[$name];
        }
        $fieldsFromForm[$name] = $this->dbo->real_escape_string($fieldsFromForm[$name]);
        if ($fieldsFromForm[$name] == '' && $val->required) {
        $emptyFieldDetected = true;
        }
        }
        // Sprawdzenie, czy wykryto puste pola
if ($emptyFieldDetected) {
    unset($fieldsFromForm['haslo']);
    unset($fieldsFromForm['haslo2']);
    $_SESSION['formData'] = $fieldsFromForm;
    return FORM_DATA_MISSING;
    }
        // Sprawdzenie, czy podany e-mail jest już w bazie
$query = "SELECT COUNT(*) FROM Klienci WHERE Email=" . $fieldsFromForm['email'] . "'";
if ($this->dbo->getQuerySingleResult($query) > 0) {
unset($fieldsFromForm['haslo']);
unset($fieldsFromForm['haslo2']);
$_SESSION['formData'] = $fieldsFromForm;
return USER_NAME_ALREADY_EXISTS;
}
        //Sprawdzenie zgodności hasła z obu pól
if ($fieldsFromForm['haslo'] != $fieldsFromForm['haslo2']) {
    unset($fieldsFromForm['haslo']);
    unset($fieldsFromForm['haslo2']);
    $_SESSION['formData'] = $fieldsFromForm;
    return PASSWORDS_DO_NOT_MATCH;
    }
        unset($fieldsFromForm['haslo2']);
        unset($this->fields['haslo2']);
        // Przygotowanie ciągów nazw pól i wartości pól dla zapytania SQL
        $fieldsNames = '' . implode(',`', array_keys($this->fields)) . '`';
        $fieldsVals = '\'' . implode('\',\'', $fieldsFromForm) . '\'';
        // Formowanie i wykonanie zapytania
        $query = "INSERT INTO Klienci ($fieldsNames) VALUES ($fieldsVals)";
        if ($this->dbo->query($query)) {
        return ACTION_OK;
        } else {
        return ACTION_FAILED;
        }
        }
}
}