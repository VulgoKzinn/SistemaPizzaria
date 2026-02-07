<?php
include "backend/conexao.php";
try {
   $sql = "SELECT * FROM tb_tipo";

   $comando = $conexao->prepare($sql);
   $comando->execute();
   $tipos = $comando->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Lista categorias</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="admin.php"><button>Home</button></a>
<a href="tipo.php"><button>Voltar</button></a>
<a href="backend/logout.php"><button>Sair</button></a></p>
    <main>
        <table>
            <tr>
                <th>Id</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
            <?php
                foreach($tipos as $tipo):            
            ?>
            <tr>
                <td><?php echo $tipo['id'];?></td>
                <td><?php echo $tipo['tipo'];?></td>
                <td>
                    <a href="editar_tipo.php?id=<?php echo $tipo['id'];?>">Editar</a>                    
                    <a href="backend/functions/deletar_tipo.php?id=<?php echo $tipo['id'];?>">Deletar</a>                    
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </table>        
    </main>
</body>
</html>