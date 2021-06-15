<?php	

if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
    if(isset($_POST["type"]) && !empty($_POST["type"])){
        $typeArticle = htmlspecialchars($_POST["type"]) ;
        addTypeArticle($typeArticle);
    }

    if(isset($_GET["deleteType"]) && $_GET["deleteType"] == true ){
        $deleteType = htmlspecialchars($_GET["value"]) ;
        $deleteType=intval($deleteType);
        deleteTypeArticle($deleteType);
    }
    
}

    $listeTypeCategorie = getCategorie();

?>

<table calss="mlr-a mt-3 p-1" id="typeArticle">
    <thead>
        <tr>
            <th colspan=2>Liste des types d'articles</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Nom de la catégorie</td>
            <td>Supprimer</td>
        </tr>
        <?php
        foreach($listeTypeCategorie as $value){
        ?>
        <tr>
                <td><?= $value["nomCategorie"]?></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeCategorie&deleteType=true&value=<?= $value["categorieid"] ?>"><i class="far fa-plus-square"></i></a></td>
        </tr>
        <?php
            }
        ?>

        <tr>
            <td>Ajouter un type</td>
            <td class="ta-c tc-g"><a href="../../src/pages/admin.php?choix=listeCategorie&createType=true/#typeArticle"><i class="far fa-plus-square"></i></a></td>
        </tr>
        <?php 
                if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
                    if(isset($_GET["createType"]) && $_GET["createType"] == true){
            ?>
                <form action="" method="post">
                        <tr>
                            <td>type d'article à ajouter</td>
                            <td class="ta-c tc-g"><input type="text" name="type" placeholder="Entrez le type d'article"></td>
                            <td><input type="submit" value="Ajouter type"></td>
                        </tr>
                </form>
            <?php
                  }
                }
            ?>
    </tbody>
</table>