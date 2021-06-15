<?php 
    $titre="Votre compte";
    require "../../src/common/template.php";
    require "../../src/fonctions/dbAccess.php";
    require "../../src/fonctions/dbFonction.php";
    require "../../src/fonctions/mesFonctions.php";
    

    if(isset($_FILES["fichier"])){
        $photo = sendImg($_FILES["fichier"],"avatar"); 
        updateImg($photo); 
        if($_SESSION["user"]["photo"] != "../../src/img/site/defaut_avatar.png") {
            unlink($_SESSION["user"]["photo"]); // efface l'avatar précédent
        }
        $_SESSION["user"]["photo"] = $photo;
        header("location: ../../src/pages/account.php?maj=true&message=Félicitaion votre avatar est mis à jour");
        exit();
    }

    
?>

<section id="account">
    <div class="account">
        <div class="infosMembre p-2">
            <a href="../../src/pages/account.php?edit=true"><img title="Cliquez pour changer votr eavatar" src="<?=$_SESSION["user"]["photo"]?>" alt="avatar de membre"></a>
            <?php 
                if(isset($_GET["edit"]) && $_GET["edit"] == true){
            ?>
                <form action="../../src/pages/account.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fichier">
                    <input type="submit" value="Envoyez votre avatar">
                </form>
            <?php 
                    if(isset($_GET["maj"]) && $_GET["maj"] == true){
                        echo "<h3>" . $_GET["message"] . "</h3>";
                    }
                }

            ?>
            <table>
                <tr>
                    <td>Pseudo</td>
                    <td><?=$_SESSION["user"]["login"]?></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><?=$_SESSION["user"]["nom"]?></td>
                </tr>
                <tr>
                    <td>Prénom</td>
                    <td><?=$_SESSION["user"]["prenom"]?></td>
                </tr>
                <tr>
                    <td>Statut</td>
                    <td><?=$_SESSION["user"]["role"]?></td>
                </tr>
            </table>
        </div>
        <div class="contenuMembre p-2">
            <?php if($_SESSION["user"]["role"] == "auteur" || $_SESSION["user"]["role"] == "admin" ){ ?>
            <h2>Vos articles</h2>
            <p>Pas d'article</p>
            <?php } ?>
            <h2>Vos commentaires</h2>
            <p>Pas de commentaires</p>
        </div>
    </div>
</section>



<?php 
    require "../../src/common/footer.php";
?>