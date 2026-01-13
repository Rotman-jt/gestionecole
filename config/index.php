<?php
function bdd()
{
    try {
        $bdd = new PDO("mysql:dbname=gestion_ecole;host:localhost","root","");
        $bdd->exec("SET NAMES UTF8");
    } 
    catch(PDOException $erreur){
        echo "connexion_echouer".$erreur->getMessage();
    }
}

?>