<?php
session_start();
include "backend/conexao.php";
include "backend/session.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Admin - Pizzaria</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>
<h1>Painel Admin</h1>
<p>Bem-vindo, <?= $_SESSION["usuario_usuario"] ?> | <a href="backend/logout.php">Sair</a></p>

<a href="cadastrar_pizza.php">Cadastro Pizza</a>
<a href="cadastrar_tipo.php">Cadastro Tipo</a>

</body>
</html>
