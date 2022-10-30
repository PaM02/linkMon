<?php
include_once 'bdd.php';

//ouverture de la session
session_start();

$option = (isset($_POST['option'])) ? $_POST['option'] : '';


switch($option){
    
    case 1:    

        $query = "SELECT * FROM evenements";
          
        $result = $bdd->prepare($query);
        $result->execute();        
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        break;    

}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$bdd=null;