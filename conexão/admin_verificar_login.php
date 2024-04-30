<?php
session_start();
//conexão com o banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

//captura os dados do formulário de login_admin.php
$nome_usuario = $_POST['nome_usuario'];
$senha = $_POST['senha'];

//confere a consulta no banco de dados
$sql = "SELECT * FROM administrador WHERE nome_usuario = ? AND senha = ?";
$stmt = $strcon->prepare($sql);
$stmt->bind_param("ss", $nome_usuario, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

// verifica se encontrou algum registro
if (mysqli_num_rows($resultado) == 1) {
    $row = $resultado->fetch_assoc();
    $_SESSION['id_administrador'] = $row['ID']; 
    $_SESSION['nome_administrador'] = $row['nome_completo'];
    // caso sim, encaminha para a tela de admin
    header("Location: admin.php");
    exit(); // encerra o script após o redirecionamento
} else {
    // mensagem de erro caso as credenciais estejam incorretas
    $mensagem_erro = "Nome de usuário ou senha incorretos.";
    // redireciona de volta para o login com a mensagem de erro
    header("Location: login_admin.php?erro=" . urlencode($mensagem_erro)); 
    exit(); // encerra o script após o redirecionamento
}
?>
