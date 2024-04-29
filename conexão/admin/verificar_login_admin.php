<?php
session_start();
// Conexão com o banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

// Captura os dados do formulário
$nome_usuario = $_POST['nome_usuario'];
$senha = $_POST['senha'];

// Consulta no banco de dados
$sql = "SELECT * FROM administrador WHERE nome_usuario = ? AND senha = ?";
$stmt = $strcon->prepare($sql);
$stmt->bind_param("ss", $nome_usuario, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se encontrou algum registro
if (mysqli_num_rows($resultado) == 1) {
    $row = $resultado->fetch_assoc();
    $_SESSION['id_administrador'] = $row['ID']; // Defina a chave da sessão conforme necessário
    $_SESSION['nome_administrador'] = $row['nome_completo']; // Se necessário, armazene outros dados do administrador na sessão
    // Redireciona para a página de administração
    header("Location: admin.php");
    exit(); // Encerra o script após o redirecionamento
} else {
    // Mensagem de erro caso as credenciais estejam incorretas
    $mensagem_erro = "Nome de usuário ou senha incorretos.";
    header("Location: login_admin.php?erro=" . urlencode($mensagem_erro)); // Redireciona de volta para o login com a mensagem de erro
    exit(); // Encerra o script após o redirecionamento
}
?>
