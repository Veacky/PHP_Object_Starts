<?php

// Debug. Désactiver en prod
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

// Rien de plus !!
include_once "db.php";

include_once "model/Beer.php";
include_once "model/Category.php";

session_start();

//include_once "controller/loginController.php";
include_once "controller/beerController.php";
include_once "controller/categoryControl.php";

include_once "view/index.php";
include_once "view/beer.php";
include_once "view/addBeer.php";
include_once "view/modifyBeer.php";
include_once "view/category.php";

//include_once "tools.php";