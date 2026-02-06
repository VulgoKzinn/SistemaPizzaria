<?php
include "backend/conexao.php";

try {
    $sql = "SELECT id,sabor,imagem FROM tb_pizza";
    $comando = $conexao->prepare($sql);
    $comando->execute();
    $pizzas = $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    echo "Erro ao buscar os dados: ".$err->getMessage();
}

// Lista as categorias
try {
    $sql = "SELECT * FROM tb_tipo";
    $comando = $conexao->prepare($sql);
    $comando->execute();
    $tipos = $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    echo "Erro ao buscar os dados: ".$err->getMessage();
}

if(isset($_POST['tipo'])){
try {
    $id = $_POST['tipo'];

    if($id == '0'){
        $sql = "SELECT id,sabor,imagem FROM tb_pizza";
    }else{
        $sql = "SELECT id,sabor,imagem FROM tb_pizza WHERE id_tipo = $id";
    }

    $comando = $conexao->prepare($sql);
    $comando->execute();
    $pizzas = $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    echo "Erro ao buscar os dados: ".$err->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <style>
        .card-img {
            width: 50%;
            height: 150px;
        }

        #myCarousel {
            --f-carousel-gap: 10px;
            --f-carousel-slide-width: 20%;
        }
    </style>
</head>
<body>
    <?php include "templates/header.php"; ?>
    <section id="filmes">
        <h2>Catálogo</h2>
        <form action="" method="post">
            <label for="tipo">Categoria</label>
            <select name="tipo" id="tipo">
                <option value="0">Todos</option>
                <?php
                    foreach($tipos as $tipo):
                    ?>
                <option value="<?php echo $tipo['id']?>">
                    <?php echo $tipo['tipo']?>
                </option>
                <?php
                endforeach;
                ?>
            </select>

            <input type="submit" value="Pesquisar">
        </form>
    </section>

    <section id="filmes">

        <section id="fantasia">
            <div class="f-carousel" id="myCarousel">
                <?php
                    foreach($pizzas as $pizza):
                    ?>
                <div class="card">
                </div>
                <div class="f-carousel__slide">
                    <img class="card-img" src="img/uploads/<?php echo $pizza['imagem'];?>">
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>
    </section>

    <?php include "templates/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/carousel/carousel.umd.js"></script>
    <script>
        const container = document.getElementById("myCarousel");
        const options = {
            // Your custom options
        };
        Carousel(container, options).init();
    </script>
</body>
</html>