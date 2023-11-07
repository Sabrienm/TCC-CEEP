<?php
function  conectar(){
    $host   = "localhost";
    $db     = "sakura";
    $user   = "root";
    $pass   = "";

    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

    return $pdo;
}
?>