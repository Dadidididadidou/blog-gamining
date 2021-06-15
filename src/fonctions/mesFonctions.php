<?php 
    function grainDeSel($x){
        $chars = "0123456789abcdef";
        $string = "";

        for($i = 0; $i < $x; $i++){
            $string .= $chars[rand(0, strlen($chars) -1)];
        }

        return $string;
    }

    function sendImg($photo, $destination){
        if($destination == "avatar"){
            $dossier = "../../src/img/avatar/" . time(); 
        }else{
            $dossier = "../../src/img/article/" . time();
        }

        $extensionArray = ["png","jpg","jpeg","jfif","PNG","JPG","JPEG","JFIF"];

        $infofichier = pathinfo($photo["name"]);
        $extensionImage = $infofichier["extension"];

        if(in_array($extensionImage, $extensionArray)){
            $dossier .= basename($photo["name"]);
            move_uploaded_file($photo["tmp_name"], $dossier);
        }
        return $dossier;
    }

    function estConnecte(){
        if(isset($_SESSION["connecté"]) && $_SESSION["connecté"] == true){
            header("location: ../../index.php");
        }
    }

    

    
?>