<?php
session_start();
include "backend/conexao.php";

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? '';
    $senha = $_POST["senha"] ?? '';

    if (empty($usuario) || empty($senha)) {
        $erro = "Preencha todos os campos!";
    } else {
        $sql = "SELECT * FROM tb_usuario WHERE usuario = :usuario AND ativo = 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($usuario);
        // var_dump($resultado);

        if ($senha === $resultado["senha"]){
            $_SESSION["usuario_id"] = $resultado["id"];
            $_SESSION["usuario_usuario"] = $resultado["usuario"];
            header("Location: admin.php");
            exit;
        } else {
            $erro = "Usuário ou senha inválidos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Pizzaria</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>

<div class="login">
    <h2>Login</h2>

    <?php if (!empty($erro)) : ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="usuario"  id="login" placeholder="Usuário">
        <input type="password" name="senha" id="login" placeholder="Senha">
        <button type="submit" id="btnlogin">Entrar</button>
    </form>
</div>

</body>
</html>
