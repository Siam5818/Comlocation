<?php
$nameserver = "127.0.0.1";
$username = "root";
$password = "";
$namedatabase = "location";

try{
    $connexion = new PDO("mysql:host =  $nameserver;dbname=$namedatabase", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    $e->getMessage();
}