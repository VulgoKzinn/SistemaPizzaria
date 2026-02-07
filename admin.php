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
<a href="admin.php"><button>Home</button></a>
<a href="backend/logout.php"><button>Sair</button></a></p>

<a href="pizza.php"><button>Cadastro Pizza</button></a>
<a href="tipo.php"><button>Cadastro Categoria</button></a>
<a href="lista_pizza.php"><button>Listagem de Pizzas</button></a>
<a href="lista_tipo.php"><button>Listagem Categoria</button></a>

</body>
</html>
