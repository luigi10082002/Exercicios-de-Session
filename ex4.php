<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeira Página</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['nome'])): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><?php echo htmlspecialchars($_SESSION['nome']); ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=encerrar">Encerrar Sessão</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if (!isset($_SESSION['nome'])): ?>
            <h1>Digite seu nome</h1>
            <form action="index.php" method="post">
                <div class="form-group">
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        <?php else: ?>
            <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
        <?php endif; ?>
    </div>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
        $_SESSION['nome'] = htmlspecialchars($_POST['nome']);
        header('Location: index.php');
        exit;
    }

    if (isset($_GET['action']) && $_GET['action'] === 'encerrar') {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
    ?>
</body>
</html>
