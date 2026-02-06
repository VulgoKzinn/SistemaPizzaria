<?php
include "../conexao.php";
try {
   $sabor        = filter_input(INPUT_POST,'sabor');
   $tipo     = filter_input(INPUT_POST,'tipo');
   $ingredientes        = filter_input(INPUT_POST,'ingredientes');
   $tamanho       = filter_input(INPUT_POST,'tamanho');
   $valor       = filter_input(INPUT_POST,'valor');

//    UPLOAD IMAGEM
$pasta_upload ='../../img/uploads/';
$extensao =pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
$hash = uniqid("img_");
$img = $hash.".".$extensao;
move_uploaded_file($_FILES['imagem']['tmp_name'],$pasta_upload.$img);

   $sql = "INSERT INTO tb_pizza(sabor,id_tipo,ingredientes,tamanho,valor,imagem)VALUES(:sabor,:tipo,:ingredientes,:tamanho,:valor,:imagem)";   

   $comando = $conexao->prepare($sql);
   $comando->bindValue(':sabor',$sabor);
   $comando->bindValue(':tipo',$tipo);
   $comando->bindValue(':ingredientes',$ingredientes);
   $comando->bindValue(':tamanho',$tamanho);
   $comando->bindValue(':valor',$valor);
   $comando->bindValue(':imagem',$img);
   $comando->execute();
//    echo "Cadastro realizado com sucesso!";
    header("Location: ../../lista_pizza.php");
} catch (PDOException $err) {
    error_log($err->getMessage());
    echo "Não foi possível cadastrar!"; 
}
?>