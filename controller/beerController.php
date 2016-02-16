<?php

    $beers = Beer::FindAll();


if(isset($_POST["action"])){
    if($_POST["action"] == "Ajouter"){
        Beer::add($_POST["name"], $_POST["categorie"]);
        header('Location: index.php?state=beers');
    }
    if($_POST["action"] == "Modifier"){
        Beer::modify($_POST["id"], $_POST["name"], $_POST["categorie"]);
        header('Location: index.php?state=beers');
    }
}
if(isset($_GET["action"])){
    if($_GET["action"] == "deleteBeer"){
        Beer::delete($_GET["idBeer"]);
        header('Location: index.php?state=beers');
    }
}