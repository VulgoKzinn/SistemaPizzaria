<?php
require_once "backend/conexao.php";
include "backend/session.php";

try {
   $sql = "SELECT 
    tb_cadastro.*,
    tb_especie.especie,
    tb_raca.raca 
   FROM tb_cadastro 
   INNER JOIN tb_especie ON tb_especie.id = tb_cadastro.id_especie 
   INNER JOIN tb_raca ON tb_raca.id = tb_cadastro.id_raca"; 

   $comando = $conexao->prepare($sql);

   $comando->execute();

   $pizzas = $comando->fetchAll(PDO::FETCH_ASSOC);
   
//    echo "<pre>";
//    var_dump($pizzas);
    
} catch (PDOException $err) {
    error_log($err->getMessage());
    echo "Não foi possível listar os dados!";    
}




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza - Lista</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>
    <?php
        require_once "menu.php";
    ?>
    <main>
        <table>
            <tr>
                <th>Id</th>
                <th>Sabor</th>
                <th>Tipo</th>
                <th>Ingredientes</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
            <?php
                foreach($pizzas as $pizza):            
            ?>
            <tr>
                <td><?php echo $pizza['id'];?></td>
                <td><?php echo $pizza['sabor'];?></td>
                <td><?php echo $pizza['tipo'];?></td>
                <td><?php echo $pizza['ingredientes'];?></td>
                <td><?php echo $pizza['categoria'];?></td>
                <td><?php echo $pizza['preco'];?></td>
                <td><?php echo $pizza['ativo'];?></td>
                <td>
                    <a href="pizza-editar.php?id=<?php echo $pizza['id'];?>">Editar</a>                    
                    <a href="backend/pizza-deletar.php?id=<?php echo $pizza['id'];?>">Deletar</a>                    
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </table>        
    </main>
</body>
</html>