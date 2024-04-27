<?php
// Conexão com o banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

// Captura os dados do formulário
$nome_usuario = $_POST['nome_usuario'];
$senha = $_POST['senha'];

// Consulta no banco de dados
$sql = "SELECT * FROM administrador WHERE nome_usuario = '$nome_usuario' AND senha = '$senha'";
$resultado = mysqli_query($strcon, $sql);

// Verifica se encontrou algum registro
if (mysqli_num_rows($resultado) == 1) {
    // Redireciona para a página de administração
    header("Location: admin.php");
    exit();
} else {
    // Mensagem de erro caso as credenciais estejam incorretas
    echo "Nome de usuário ou senha incorretos.";
}
?>
