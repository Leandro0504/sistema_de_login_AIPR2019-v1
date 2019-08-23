<?php
//configDB.php

//Dados para escolha di DataBase (DB)
$dbhost = "localhost";
$dbuser = "root"; // Usuário raíz (Rute) 
$dbpass = "";
$dbname = "sistemaDeLogin";

//Conexão com o banco de dados
$conecta = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($conecta->connect_error){
    die("Não foi possível conectar ao Banco de Dados: " . $conecta->connect_error);
}else{
    echo "<h1>Conectou no BD Manowwwww!</h1>";
}