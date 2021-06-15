<?php 
    if(isset($_GET["deconnect"]) && $_GET["deconnect"]== true){
        $_SESSION["connecté"]=false;
        session_destroy();
        header("location: ./index.php");
        exit();
    }
?>

<header class="bg">
    <div>
        <a href="../../index.php"><img src="../../src/img/site/logotest.gif" alt="Logo Site Belgium Video-Gaming"></a>
    </div>
    <nav>
        <ul>
            <li><a href="../../src/pages/index.php">PS5</a></li>
            <li><a href="">PS4</a></li>
            <li><a href="">XBOX ONE</a></li>
            <li><a href="">SWITCH</a></li>
            <li><a href="">PC</a></li>
            <li><a href="">VR</a></li>
        </ul>
    </nav>
    <div>
    <nav>
    <?php 
        if(!isset($_SESSION["connecté"]) || $_SESSION["connecté"] == false){
            ?>
            <ul>
                <li><a href="../../src/pages/login.php"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                <li><a href="../../src/pages/register.php"><i class="fas fa-user-plus"></i>S'enregistrer</a></li>
            </ul>
            <?php
        }
        if(isset($_SESSION["connecté"]) && $_SESSION["connecté"] == true){
            ?>
            <ul>
                <li><a href="../../src/pages/account.php"><i class="fas fa-user">Mon compte</i></a></li>
                <li><a href="../../index.php?deconnect=true"><i class="fas fa-alt-slash">Déconnecter</i></a></li>
            <?php }
                if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "auteur" || isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
            ?>
                <li><a href="../../src/pages/rediger.php"><i class="fas fa-edit">Rédiger</i></a></li>

            <?php  
        }   
        if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
            ?>
                <li><a href="../../src/pages/admin.php"><i class="fas fa-user-shield">Admin</i></a></li>
            <?php  
        }
            ?>

            </ul>
            
        
            
        
    </nav>
    </div>
</header>