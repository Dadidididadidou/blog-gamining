<?php	

if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
    if(isset($_POST["gameCat"]) && !empty($_POST["gameCat"])){
        $gameCat = htmlspecialchars($_POST["gameCat"]) ;
        addGameCategorie($gameCat);
    }

    if(isset($_GET["deleteGameCat"]) && $_GET["deleteGameCat"] == true ){
        $gameCatId = htmlspecialchars($_GET["value"]) ;
        $gameCatId=intval($gameCatId);
        deleteGameCategorie($gameCatId);
    }
    
}
$listeCategorie = getGameCategorie();
?>

<table calss="mlr-a mt-3 p-1" id="gameCat">
    <thead>
        <tr>
            <th colspan=2>Liste des types de jeu</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Nom de la catégorie</td>
            <td>Supprimer</td>
        </tr>
        <?php
        foreach($listeCategorie as $value){
        ?>
        <tr>
                <td><?= $value["genre"]?></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeCategorie&deleteGameCat=true&value=<?= $value["gameCategoryid"] ?>"><i class="far fa-plus-square"></i></a></td>
        </tr>
        <?php
            }
        ?>

        <tr>
            <td>Ajouter un genre</td>
            <td class="ta-c tc-g"><a href="../../src/pages/admin.php?choix=listeCategorie&createGameCat=true/#gameCat"><i class="far fa-plus-square"></i></a></td>
        </tr>
        <?php 
                if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
                    if(isset($_GET["createGameCat"]) && $_GET["createGameCat"] == true){
            ?>
                <form action="" method="post">
                        <tr>
                            <td>catégorie de jeu à ajouter à ajouter</td>
                            <td class="ta-c tc-g"><input type="text" name="gameCat" placeholder="Entrez la catégorie de jeu"></td>
                            <td><input type="submit" value="Ajouter categorie"></td>
                        </tr>
                </form>
            <?php
                  }
                }
            ?>
    </tbody>
</table>