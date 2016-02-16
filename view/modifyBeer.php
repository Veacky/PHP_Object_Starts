<?php
if(isset($_GET["state"]) && $_GET["state"] == "modifyBeer") {
    $id = $_GET["idBeer"];
    $beer = Beer::findByID($id);

    ?>
    <h2>Modifier une bière</h2>

    <form method="post" action="index.php">
        <label name="id">ID :</label>
        <input type="text" name="id" value="<?php echo $beer->idbeer ?>"/>
        <label name="name">Nom :</label>
        <input type="text" name="name" value="<?php echo $beer->name ?>"/>
        <label name="categorie">Catégorie :</label>
        <SELECT name="categorie">
            <?php foreach ($categories as $category) {
                if($category->idcategory == $beer->idcategory->idcategory)
                    echo "<option value=".$category->idcategory." selected>".$category->name."</option>";
                else echo "<option value=".$category->idcategory.">".$category->name."</option>";
            } ?>
        </SELECT>
        <input type="submit" name="action" value="Modifier">
    </form>
    <?php
}