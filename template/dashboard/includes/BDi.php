<?php
    date_default_timezone_set('Europe/Lisbon');
    $hostname_DB = "localhost";
    $database_DB = "id20208460_gestaoequipamentos_db";     // Nome da base de dados
    $username_DB = "id20208460_gestaoequipamentos";     // Utilizador
    $password_DB = "(--c6sLw{#pj)O-h";     // Password


    $DB = new mysqli($hostname_DB, $username_DB, $password_DB, $database_DB);
    if ($DB->connect_error)
        die("Falhou a ligação: " . $DB->connect_error);

    $DB->query("SET NAMES 'utf8'");

?>