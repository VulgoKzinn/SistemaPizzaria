<?php
include "../conexao.php";

try {
   $id          = filter_input(INPUT_GET,'id');
   $tipo        = filter_input(INPUT_POST,'tipo');
   
   $sql = "UPDATE tb_tipo SET 
    tipo=:tipo,
   WHERE id =:id";   

   $comando = $conexao->prepare($sql);
   $comando->bindValue(':id',$id);
   $comando->bindValue(':tipo',$tipo);
   $comando->execute();

    header("Location: ../../lista_tipo.php");

} catch (PDOException $err) {
    error_log($err->getMessage());
    
    echo "Não foi possível Editar!"; 
}



?>