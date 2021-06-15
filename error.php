
<?php 
    switch($_GET["code"]){
        case '404' :
            header('location: ../../index.php');
            exit();
            break;
        default:
            header('location: ../../index.php');
            exit();
    }
?>