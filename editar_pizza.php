<?php
include "backend/conexao.php";

try {
   $id = filter_input(INPUT_GET,'id');

   $sql = "SELECT * FROM tb_pizza WHERE id = :id";
   $comando = $conexao->prepare($sql);
   $comando->bindValue(':id',$id);  
   $comando->execute();
   $dados = $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    error_log($err->getMessage());
    echo "Não foi possível listar os dados!";    
}

try {
   $sql = "SELECT * FROM tb_tipo WHERE ativo = 1";
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
    <title>Editar Pizza</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<a href="admin.php"><button>Home</button></a>
<a href="lista_pizza.php"><button>Voltar</button></a>
<a href="backend/logout.php"><button>Sair</button></a></p>
    <main>
        <form action="backend/functions/atualizar_pizza.php?id=<?php echo $dados[0]['id']?>" method="POST" enctype="multipart/form-data">
            <input type="text" value="<?php echo $dados[0]['sabor'];?>" name="sabor" placeholder="Sabor da Pizza" required><br><br>
            <textarea name="ingredientes" placeholder="Ingredientes" required><?php echo $dados[0]['ingredientes'];?></textarea><br><br>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <?php foreach ($tipos as $tipo): ?>

                <option
                <?php if($dados[0]['id_tipo']==$tipo['id']) echo "selected";?> 

                value="<?php echo $tipo['id'];?>">

                    <?php echo $tipo['tipo'];?>

                </option>

                <?php endforeach; ?>
            </select><br><br>
            <select name="tamanho" required>
                <option value="" disabled selected>Selecione o Tamanho</option>
                
                <option 
                <?php if($dados[0]['tamanho']=='P') echo "selected";?>
                value="P">Pequena 4x</option>
                
                <option 
                <?php if($dados[0]['tamanho']=='M') echo "selected";?>
                value="M">Média 8x</option>
                
                <option 
                <?php if($dados[0]['tamanho']=='Q') echo "selected";?>
                 value="Q">Quadrada 16x</option>

            </select><br><br>
            <input type="number" value="<?php echo $dados[0]['valor'];?>" name="valor" step="0.01" placeholder="Preço" required><br><br>
            <input type="file" name="imagem"><br><br>
            <button type="submit" name="cadastrar_pizza">Salvar Pizza</button>
        </form>
    </main>
</body>

</html>