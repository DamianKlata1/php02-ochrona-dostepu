<?php
require_once dirname(__FILE__).'/../../config.php';

function getParamsLogin(&$form)
{
    $form['login'] = isset ($_REQUEST ['login']) ? $_REQUEST ['login'] : null;
    $form['pass'] = isset ($_REQUEST ['pass']) ? $_REQUEST ['pass'] : null;
}

function validateLogin(&$form, &$messages)
{

    if (!(isset($form['login']) && isset($form['pass']))) {
        return false;
    }
    if ($form['login'] == "") {
        $messages [] = 'Nie podano loginu';
    }
    if ($form['pass'] == "") {
        $messages [] = 'Nie podano hasła';
    }
    if (!empty($messages)) {
        return false;
    }

    if ($form['login'] == "admin" && $form['pass'] == "admin") {
        session_start();
        $_SESSION['role'] = 'admin';
        return true;
    }
    if ($form['login'] == "user" && $form['pass'] == "user") {
        session_start();
        $_SESSION['role'] = 'user';
        return true;
    }

    $messages [] = 'Niepoprawny login lub hasło';
    return false;
}
$form = array();
$messages = array();

getParamsLogin($form);

if (!validateLogin($form,$messages)) {

    include _ROOT_PATH.'/app/security/login_view.php';
} else {

    //ok przekieruj lub "forward" na stronę główną

	//redirect - przeglądarka dostanie ten adres do "przejścia" na niego (wysłania kolejnego żądania)
	header("Location: "._APP_URL);

	//"forward"
	//include _ROOT_PATH.'/index.php';
}