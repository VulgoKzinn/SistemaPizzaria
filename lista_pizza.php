<?php
include "backend/conexao.php";

try {
   $sql = "SELECT 
    tb_pizza.*,
    tb_tipo.tipo 
   FROM tb_pizza 
   INNER JOIN tb_tipo ON tb_tipo.id = tb_pizza.id_tipo"; 

   $comando = $conexao->prepare($sql);
   $comando->execute();
   $pizzas = $comando->fetchAll(PDO::FETCH_ASSOC);
//    echo "<pre>";
//    var_dump($pets);
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
    <title>Adote um Pet - Lista</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <table>
            <tr>
                <th>Id</th>
                <th>Sabor</th>
                <th>Categoria</th>
                <th>Ingredientes</th>
                <th>Tamanho</th>
                <th>Valor</th>
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
                <td><?php echo $pizza['tamanho'];?></td>
                <td><?php echo $pizza['valor'];?></td>
                <td><?php echo $pizza['ativo'];?></td>
                <td>
                    <a href="editar_pizza.php?id=<?php echo $pizza['id'];?>">Editar</a>                    
                    <a href="backend/deletar_piza.php?id=<?php echo $pizza['id'];?>">Deletar</a>                    
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </table>        
    </main>
</body>
</html>