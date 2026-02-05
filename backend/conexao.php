<?php
try{
    define("SERVIDOR","localhost");
    define("USUARIO","root");
    define("SENHA","");
    define("BANCO","db_pizzaria");

    $conexao = new PDO("mysql:host=".SERVIDOR.";dbname=".BANCO.";charset=utf8mb4",USUARIO,SENHA);

    $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "Conectado com sucesso!";
}catch(PDOException $err){
    echo "Erro ao conectar no banco de dados".$err->getMessage();
}
?>