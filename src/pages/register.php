<?php 
    $titre="Enregistrez-vous";
    require "../../src/common/template.php";
    require "../../src/fonctions/mesFonctions.php";
    require "../../src/fonctions/dbAccess.php";
    require "../../src/fonctions/dbFonction.php";

    estConnecte();

    if(isset($_SESSION["mdpNok"]) && $_SESSION["mdpNok"] == true){
        $mdpNok = $_SESSION["mdpNok"];
        $_SESSION["mdpNok"] = false;
    }else{
        $mdpNok = false;
    }

    if(isset($_POST["nom"]) && !empty($_POST["login"])
    && !empty($_POST["prenom"]) && !empty($_POST["email"])
    && !empty($_POST["mdp"]) && !empty($_POST["mdp2"])){


        $photo = "../../src/img/site/avatar.png";

        $option= array(
            "nom"   => FILTER_SANITIZE_STRING,
            "prenom"   => FILTER_SANITIZE_STRING,
            "login"   => FILTER_SANITIZE_STRING,
            "email"   => FILTER_VALIDATE_EMAIL,
            "mdp"     => FILTER_SANITIZE_STRING,
            "mdp2"     => FILTER_SANITIZE_STRING,
        );

        $result= filter_input_array(INPUT_POST, $option);

        $nom = $result["nom"];
        $prenom= $result["prenom"];
        $login= $result["login"];;
        $email= $result["email"];
        $mdp= $result["mdp"];
        $mdp2= $result["mdp2"];
        $role=4;

        if($mdp == $mdp2){
            $mdpHash = md5($mdp);
            $sel = grainDeSel(rand(5,20));
            $mdpToSend = $mdpHash . $sel;
            $mdpNok=false;
        }else{
            $mdpNok = true;
            $_SESSION["mdpNok"] = true;
            header("location: ../../src/pages/register.php");
            exit();
        }

        $bdd= new PDO("mysql:host=localhost;dbname=blog-gaming;charset=utf8", "root", "");

        $requete = $bdd->prepare("SELECT COUNT(*) AS x
                                    FROM users
                                    WHERE login = ?");

        $requete->execute(array($login));

        while($result = $requete ->fetch()){
            if($result["x"] != 0){
                $_SESSION["msgLogin"] = true;
                header("location: ../../src/pages/register.php");
                exit();
            }
        }

        // Check mail

        $requete = $bdd->prepare("SELECT COUNT(*) AS x
                                    FROM users
                                    WHERE email = ?");

        $requete->execute(array($email));

        while($result = $requete ->fetch()){
            if($result["x"] != 0){
                $_SESSION["msgEmail"] = true;
                header("location: ../../src/pages/register.php");
                exit();
            }
        }

        if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){
            $photo = sendImg($_FILES["fichier"], "avatar");
        }

        createUser($photo,$login,$nom,$prenom,$email,$mdpToSend,$role,$sel);
        ?>
        <h2 class="registerOk"> Votre compte est maintenant créé, vous pouvez vous  <a href="../../src/pages/login.php">CONNECTER</a> </h2>
        <?php
    } else {
    
?>


<section class="register">

        <?php 
            if(isset($_SESSION["msgEmail"]) && $_SESSION["msgEmail"] == true){
                echo "<h2> cet email possède déjà un compte, veuillez vous connecter </h2>";
                $_SESSION["msgEmail"] = false;
            }

            if(isset($_SESSION["msgLogin"]) && $_SESSION["msgLogin"] == true){
                echo "<h2> ce login  possède déjà un compte, veuillez vous connecter </h2>";
                $_SESSION["msgLogin"] = false;
            }
            if($mdpNok == true ){
                $mdpNok = false;
                echo "<h2>Les 2 mots d epasse ne sont pas identique</h2>";
            }
        ?>

    <form action="" method="post" class="login" enctype="multipart/form-data">
        <table>

            <thead>
                <tr>
                    <th colspan="2"> Créez votre compte</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prénom:</td>
                    <td><input type="text" name="prenom" required placeholder="Entrez votre prénom"></td>
                </tr>
                <tr>
                    <td>Nom:</td>
                    <td><input type="text" name="nom" required placeholder="Entrez votre nom"></td>
                </tr>
                <tr>
                    <td>Login:</td>
                    <td><input type="text" name="login" required placeholder="Entrez votre login"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" required placeholder="Entrez votre email"></td>
                </tr>
                <tr>
                    <td>Mot de passe:</td>
                    <td><input type="password" name="mdp" required placeholder="Entrez votre mot de passe" class="danger" placeholder="mot de passe pas identique"> </td>
                </tr>
                <tr>
                    <td>Mot de passe:</td>
                    <td><input type="password" name="mdp2" required placeholder="Répétez votre mot de passe"></td>
                </tr>
                <tr>
                    <td>Envoyer votre avatar:</td>
                    <td><input type="file" name="fichier"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Créer votre compte"></td>
                </tr>
            </tbody>

        </table>
    </form>
</section>

<?php 
    }
    require "../../src/common/footer.php";

    
?>