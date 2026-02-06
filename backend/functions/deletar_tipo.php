<?php
include "../conexao.php";
try {
    $id = filter_input(INPUT_GET,'id');
    $sql = "DELETE FROM tb_tipo WHERE id = :id";
    $comando = $conexao->prepare($sql);
    $comando->bindValue(':id',$id);   
    $comando->execute();
    header("Location: ../../lista_tipo.php");
  
} catch (PDOException $err) {
    error_log($err->getMessage());
    echo "Não foi possível realizar a operação!"; 
}
?>