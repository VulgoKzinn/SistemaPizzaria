<?php
session_start();
include "backend/conexao.php";
include "backend/session.php";

// Cadastrar pizza
if (isset($_POST['cadastrar_pizza'])) {
    $sabor = trim($_POST['sabor'] ?? '');
    $ingredientes = trim($_POST['ingredientes'] ?? '');
    $categoria = intval($_POST['categoria'] ?? 0);
    $preco = floatval($_POST['preco'] ?? 0);
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    // Upload de imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = 'uploads/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
    }

    $stmt = $conexao->prepare("INSERT INTO tb_pizza (sabor, ingredientes, categoria, preco, imagem, ativo) 
                               VALUES (:sabor, :ingredientes, :categoria, :preco, :imagem, :ativo)");
    $stmt->execute([
        ':sabor' => $sabor,
        ':ingredientes' => $ingredientes,
        ':categoria' => $categoria,
        ':preco' => $preco,
        ':imagem' => $imagem,
        ':ativo' => $ativo
    ]);
    header("Location: lista_pizza.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>
    <h2>Cadastrar Pizza</h2>
<?php if (!empty($msg_pizza)) echo "<p style='color:green;'>$msg_pizza</p>"; ?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="sabor" placeholder="Sabor da Pizza" required><br><br>
    <textarea name="ingredientes" placeholder="Ingredientes" required></textarea><br><br>
    <select name="categoria" required>
        <option value="">Selecione o tipo</option>
        <?php foreach ($tipos as $tipo): ?>
            <option value="<?= $tipo['id'] ?>"><?= $tipo['tipo'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="number" name="preco" step="0.01" placeholder="Preço" required><br><br>
    <input type="file" name="imagem"><br><br>
    <label><input type="checkbox" name="ativo" checked> Ativo</label><br><br>
    <button type="submit" name="cadastrar_pizza">Cadastrar Pizza</button>
</form>
</body>
</html>