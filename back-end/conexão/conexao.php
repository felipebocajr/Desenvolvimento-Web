<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunsage_db";

// Conexão
$conn = mysqli_connect($servername, $username, $password);

// Verificar conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Selecionar banco de dados
$db_selected = mysqli_select_db($conn, $dbname);
if (!$db_selected) {
    die("Erro ao selecionar o banco de dados '" . $dbname . "': " . mysqli_error($conn));
}

echo "Conexão bem-sucedida";
?>