<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Tipo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <form action="backend/functions/cadastrar_tipo.php" method="POST">
            <div id="grid">
                <div>
                    <label for="raca">categoria</label>
                    <input type="text" name="tipo" id="tipo" required>
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </main>
</body>
</html>