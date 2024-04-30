<?php
session_start();

// Verifica se há uma mensagem de erro na URL
$mensagem_erro = isset($_GET['erro']) ? $_GET['erro'] : '';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link rel="stylesheet" href="login_styles.css">
</head>

<body>

    <div class="container">
        <h1>SunSage<h1>
                <h2>Login de Administrador</h2>
                <?php if (!empty($mensagem_erro)): ?>
                    <p style="color: red;"><?php echo $mensagem_erro; ?></p>
                <?php endif; ?>
                <form action="admin_verificar_login.php" method="post">
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>

                    <button type="submit">Entrar</button>
                </form>
    </div>
</body>

</html>