<?php

function Login($login, $password){
    $st = bd()->prepare("SELECT * FROM users WHERE login='".$login."' and password='".md5($password)."'");
    $st->exectue();
    if($st->fetch(PDO::FETCH_ASSOC) != 0){
        $reponse = true;
    }
    else $reponse = false;

    return $reponse;
}

function displayFormLogin(){
?>
<form action="index.php" method="post">
    <label for="login">Login :</label>
    <input id="login" type="text" name="login">
    <label for="password">Mot de passe :</label>
    <input id="password" type="text" name="password">
    <input name ="action" type="submit" value="Login">
</form>
<?php
}

function displayLogout(){
    ?>
    <form action="index.php" method="post">
        <input name ="action" type="submit" value="Logout">
    </form>
    <?php
}