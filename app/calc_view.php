<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8"/>
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>
<div style="width:90%; margin: 2em auto;">
<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
    <legend>Kalkulator</legend>
    <fieldset>
        <label for="id_amount">Kwota:</label>
        <input id="id_amount" name="amount" type="text" value="<?php printIfSet($amount); ?>"/>
        <label for="id_years">Ile lat?:</label>
        <input id="id_years" name="years" type="text" value="<?php printIfSet($years); ?>"/>
        <label for="id_interest">Oprocentowanie:</label>
        <input id="id_years" name="interest" type="text" value="<?php printIfSet($interest); ?>"/>
    </fieldset>
    <input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>;
</form>
</div>
<?php
    if (isset($messages)) {
        if (count($messages) > 0) {
            echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
            foreach ($messages as $key => $msg) {
                echo '<li>' . $msg . '</li>';
            }
            echo '</ol>';
        }
    }
?>

<?php
    if (isset($result)) {
        echo '<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">';
        echo 'Wynik: ' . $result;
        echo '</div>';
    }
?>


</body>
</html>