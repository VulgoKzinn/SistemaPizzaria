<?php
include "backend/conexao.php";

try {
   $id = filter_input(INPUT_GET,'id');

   $sql = "SELECT * FROM tb_tipo WHERE id = :id";
   $comando = $conexao->prepare($sql);
   $comando->bindValue(':id',$id);  
   $comando->execute();
   $dados = $comando->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Cadastrar Categoria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="admin.php"><button>Home</button></a>
<a href="lista_tipo.php"><button>Voltar</button></a>
<a href="backend/logout.php"><button>Sair</button></a></p>
    <main>
        <form action="backend/functions/cadastrar_tipo.php" method="POST">
            <div id="grid">
                <div>
                    <label for="categoria">Categoria</label>
                    <input type="text" value="<?php echo $dados[0]['tipo'];?>" name="tipo" id="tipo" required>
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </main>
</body>
</html>