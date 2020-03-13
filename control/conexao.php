<?php

    $server="mysql:dbname=banco;host=localhost";
    $user="root";
    $pass="";

    try {
        $conn=new PDO($server, $user, $pass);
        
    } catch (PDOException $e) {
        echo"Erro: ".$e->getMessage();
    }


?>