<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conectar ao banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senhaBanco = "";
    $banco = "nequa01";

    $conexao = mysqli_connect($servidor, $usuario, $senhaBanco, $banco);
    if (mysqli_connect_errno()) {
        die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Verificar na tabela "nequa_cadastrop"
    $sql = "SELECT id, nome FROM nequa_cadastrop WHERE email = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nome);

    if (mysqli_stmt_fetch($stmt)) {
        $_SESSION["id_usuario"] = $id;
        $_SESSION["nome_usuario"] = $nome;
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header("Location: ../paginaprincipal.php"); // Redirecionar para a página principal
        exit;
    }

    // Verificar na tabela "nequa_cadastroe"
    $sql = "SELECT id, nome FROM nequa_cadastroe WHERE email = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nome);

    if (mysqli_stmt_fetch($stmt)) {
        $_SESSION["id_usuario"] = $id;
        $_SESSION["nome_usuario"] = $nome;
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header("Location: ../paginaprincipal.php"); // Redirecionar para a página principal
        exit;
    }

    // Caso nenhum login seja válido
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    echo "Login inválido";
}
?>
