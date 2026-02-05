<?php
session_start();
include "backend/conexao.php";
include "backend/session.php";

// Cadastrar tipo
if (isset($_POST['cadastrar_tipo'])) {
    $tipo = trim($_POST['tipo'] ?? '');
    if ($tipo !== '') {
        $stmt = $conexao->prepare("INSERT INTO tb_tipo (tipo) VALUES (:tipo)");
        $stmt->bindParam(":tipo", $tipo);
        $stmt->execute();
        header("Location: admin.php");
    }
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
    <h2>Cadastrar Tipo de Pizza</h2>
<?php if (!empty($msg_tipo)) echo "<p style='color:green;'>$msg_tipo</p>"; ?>
<form method="POST">
    <input type="text" name="tipo" placeholder="Ex: Tradicional" required>
    <button type="submit" name="cadastrar_tipo">Cadastrar Tipo</button>
</form>
</body>
</html>