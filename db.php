<?php

// ToDo : Vérifier que la connexion est OK
$db = new PDO("pgsql:host=localhost;port=5433;dbname=PG_grandval","grandval","gYepOb");

// Pour éviter d'avoir à réutiliser "global" par la suite
function db() {
    global $db;
    return $db;
}