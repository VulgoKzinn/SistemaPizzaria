<?php
include "../conexao.php";

try {
    $id            = filter_input(INPUT_POST,'id');
    $sabor        = filter_input(INPUT_POST,'sabor');
    $tipo     = filter_input(INPUT_POST,'tipo');
    $ingredientes        = filter_input(INPUT_POST,'ingredientes');
    $tamanho       = filter_input(INPUT_POST,'tamanho');
    $valor       = filter_input(INPUT_POST,'valor');
    $img         = filter_input(INPUT_POST,'imagem');
   
   $sql = "UPDATE tb_pizza SET 
    sabor=:sabor,
    id_tipo=:tipo,
    ingredientes=:ingredientes,
    tamanho=:tamanho,
    valor=:valor,
    imagem=:imagem
   WHERE id =:id";   

   $comando = $conexao->prepare($sql);

   $comando->bindValue(':id',$id);
   $comando->bindValue(':sabor',$sabor);
   $comando->bindValue(':tipo',$tipo);
   $comando->bindValue(':ingredientes',$ingredientes);
   $comando->bindValue(':tamanho',$tamanho);
   $comando->bindValue(':valor',$valor);
   $comando->bindValue(':imagem',$img);
   
   $comando->execute();

    header("Location: ../../lista_pizza.php");

} catch (PDOException $err) {
    error_log($err->getMessage());
    
    echo "Não foi possível Editar!"; 
}

?>