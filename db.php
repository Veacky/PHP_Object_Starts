<?php

// ToDo : V�rifier que la connexion est OK
$db = new PDO("pgsql:host=localhost;port=5433;dbname=PG_grandval","grandval","gYepOb");

// Pour �viter d'avoir � r�utiliser "global" par la suite
function db() {
    global $db;
    return $db;
}