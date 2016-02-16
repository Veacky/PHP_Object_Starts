<?php
    if(isset($_GET["state"]) && $_GET["state"] == "categories") {
        ?>
        <h2>Liste des catégories</h2>

        <table>
            <?php
            foreach ($categories as $category) {
                echo "<tr>";
                echo "<td><a href=view/once&id=".$category->idcategory."'>".$category->name."</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
    }