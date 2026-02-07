<?php
include "backend/conexao.php";

/* BUSCA TIPOS */
$sql = "SELECT * FROM tb_tipo";
$tipos = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

/* FILTRO */
$filtro = $_POST['tipo'] ?? 0;

if ($filtro == 0) {
    $sql = "SELECT * FROM tb_pizza";
    $stmt = $conexao->prepare($sql);
} else {
    $sql = "SELECT * FROM tb_pizza WHERE id_tipo = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':id', $filtro, PDO::PARAM_INT);
}

$stmt->execute();
$pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cardápio | Pizzaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png">

    <style>
        body {
            background: #f8f8f8;
            font-family: Arial, Helvetica, sans-serif;
        }

        .filtro {
            max-width: 1200px;
            margin: 30px auto;
            text-align: center;
        }

        .filtro select,
        .filtro input {
            padding: 10px;
            margin: 5px;
        }

        .cardapio {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
            overflow: hidden;
            text-align: center;
            transition: transform .2s;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card h3 {
            padding: 15px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>

<?php include "templates/header.php"; ?>

<section class="filtro">
    <h2>🍕 Nosso Cardápio</h2>

    <form method="post">
        <label>Categoria:</label>
        <select name="tipo">
            <option value="0">Todas</option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['id']; ?>" <?= ($filtro == $tipo['id']) ? 'selected' : ''; ?>>
                    <?= $tipo['tipo']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filtrar">
    </form>
</section>

<section class="cardapio">
    <?php if (count($pizzas) == 0): ?>
        <p>Nenhuma pizza encontrada 🍕</p>
    <?php endif; ?>

    <?php foreach ($pizzas as $pizza): ?>
        <div class="card">
            <img src="img/uploads/<?= $pizza['imagem']; ?>" alt="<?= $pizza['sabor']; ?>">
            <h3><?= $pizza['sabor']; ?> - R$ <?= $pizza['valor']; ?></h3>
            <h4><?= $pizza['ingredientes']; ?></h4>
        </div>
    <?php endforeach; ?>
</section>

<?php include "templates/footer.php"; ?>

</body>
</html>
