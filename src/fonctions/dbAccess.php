<?php 
    function dbAccess(){
        try{
            $bdd= new PDO("mysql:host=localhost;dbname=blog-gaming;charset=utf8", "root", "");
            return $bdd;
        }catch(PDOException $e){
            echo $e->getMessage();
            echo $e->getLine();
        }
        
    }


?>