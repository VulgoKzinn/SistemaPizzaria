<?php
include "../conexao.php";
try {
   $tipo        = filter_input(INPUT_POST,'tipo');   
   $sql = "INSERT INTO tb_tipo(tipo)VALUES(:tipo)";
   $comando = $conexao->prepare($sql);
   $comando->bindValue(':tipo',$tipo);
   $comando->execute();
   header('Location: ../../lista_tipo.php');

} catch (PDOException $err) {
    error_log($err->getMessage());
    echo "Não foi possível cadastrar!"; 
}
?>