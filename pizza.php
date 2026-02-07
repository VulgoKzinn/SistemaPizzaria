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
    <title>Cadastrar Pizza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="admin.php"><button>Home</button></a>
<a href="backend/logout.php"><button>Sair</button></a></p>
    <main>
        <form action="backend/functions/cadastrar_pizza.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="sabor" placeholder="Sabor da Pizza" required><br><br>
            <textarea name="ingredientes" placeholder="Ingredientes" required></textarea><br><br>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['id'] ?>">
                    <?= $tipo['tipo'] ?>
                </option>
                <?php endforeach; ?>
            </select><br><br>
            <select name="tamanho" required>
                <option value="" disabled selected>Selecione o Tamanho</option>
                <option value="P">Pequena 4x</option>
                <option value="M">Média 8x</option>
                <option value="Q">Quadrada 16x</option>
            </select><br><br>
            <input type="number" name="valor" step="0.01" placeholder="Preço" required><br><br>
            <input type="file" name="imagem"><br><br>
            <button type="submit" name="cadastrar_pizza">Cadastrar Pizza</button>
        </form>
    </main>
</body>
</html>