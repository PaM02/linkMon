<?php 
try
{
    //23R@bichr@khli1234
    $servername = 'localhost';
    $root = 'root';
    $db = 'linkonmonitoring';
    $pwd = '';

    $bdd = new PDO('mysql:host='.$servername.';dbname='.$db.';charset=utf8', $root, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
