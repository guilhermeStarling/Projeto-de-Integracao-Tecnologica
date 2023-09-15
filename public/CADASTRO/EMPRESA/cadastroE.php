<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $endereco = $_POST["endereco"];
    $cnpj = $_POST["cnpj"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST['confirmar_senha'];

    // Conectar ao banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senhaBanco = "";
    $banco = "nequa01";

    $conexao = mysqli_connect($servidor, $usuario, $senhaBanco, $banco);
    if (mysqli_connect_errno()) {
        die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    if ($senha !== $confirmarSenha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Inserir os dados na tabela
    $sql = "INSERT INTO nequa_cadastroe (nome, email, telefone, cidade, estado, endereco, cnpj, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $nome, $email, $telefone, $cidade, $estado, $endereco, $cnpj, $senha);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header("Location: ../../LOGIN/index.html"); // Redirecionar para a página de login
        exit;
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
?>
