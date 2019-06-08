<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/MolybdenumWeb/backend/Database/Database.class.php');
    $db = new Database();

    foreach($db->executePlainQuery("SELECT * FROM events") as $key){
        foreach($key as $a){
            echo $a;
        }
        echo "\n";
    }
?>