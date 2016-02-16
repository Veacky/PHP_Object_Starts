<?php
if(isset($_GET["state"]) && $_GET["state"] == "addBeer") {
    ?>
    <h2>Ajouter une bière</h2>

    <form method="post" action="index.php">
        <label name="name">Nom :</label>
        <input type="text" name="name"/>
        <label name="categorie">Catégorie :</label>
        <SELECT name="categorie">
            <?php foreach ($categories as $category) {
                echo "<option value=".$category->idcategory.">".$category->name."</option>";
            } ?>
        </SELECT>
        <input type="submit" name="action" value="Ajouter">
    </form>
    <?php
}
