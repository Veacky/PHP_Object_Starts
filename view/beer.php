
<?php
if(isset($_GET["state"]) && $_GET["state"] == "beers") {
    ?>
    <h2>Liste des bières</h2>
    <a href="?state=addBeer">Ajouter une bière</a>
    <table>
        <?php
        foreach ($beers as $beer) {
            echo "<tr>";
            echo "<td><a href=view/once&id=".$beer->idbeer."'>".$beer->name."</a></td>";
            echo "<td>".$beer->idcategory->name."</td>";
            echo "<td><a href='?state=modifyBeer&idBeer=".$beer->idbeer."'>Modifier</td>";
            echo "<td><a href='?action=deleteBeer&idBeer=".$beer->idbeer."'>Supprimer</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
}