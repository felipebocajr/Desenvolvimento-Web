<?php
session_start();

// verifica se o administrador está logado 
if (!isset($_SESSION['id_administrador'])) {
    // Se o administrador não estiver logado, retorna um erro
    echo "error";
    exit();
}

// verifica se foi recebido o ID da vaga e a ação a ser executada
if (isset($_POST['vaga_id']) && isset($_POST['action'])) {
    // Inclui o arquivo de configuração do banco de dados
    $strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

    // obtém o ID da vaga e a ação a ser executada
    $vagaID = $_POST['vaga_id'];
    $action = $_POST['action'];

    // verifica se a ação é aumentar ou diminuir
    if ($action == 'aumentar') {
        // atualiza o número de vagas livres na tabela vaga
        $sql = "UPDATE vaga SET vagas_livres = vagas_livres + 1 WHERE ID = ?";
        $stmt = $strcon->prepare($sql);
        $stmt->bind_param("i", $vagaID);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif ($action == 'diminuir') {
        // verifica se há vagas disponíveis para diminuir
        $sql_check = "SELECT vagas_livres FROM vaga WHERE ID = ?";
        $stmt_check = $strcon->prepare($sql_check);
        $stmt_check->bind_param("i", $vagaID);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row = $result_check->fetch_assoc();
        $vagasLivres = $row['vagas_livres'];
        if ($vagasLivres <= 0) {
            echo "not_enough_vacancies";
        } else {
            // atualiza o número de vagas livres na tabela vaga
            $sql = "UPDATE vaga SET vagas_livres = vagas_livres - 1 WHERE ID = ?";
            $stmt = $strcon->prepare($sql);
            $stmt->bind_param("i", $vagaID);
            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }
} else {
    // se os parâmetros não foram recebidos corretamente, retorna um erro
    echo "error";
}
?>
