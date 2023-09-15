<?php
// Conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "nequa01";

$conexao = new mysqli($host, $usuario, $senha, $banco);
if ($conexao->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conexao->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obter os dados do template do formulário
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $arquivo = $_FILES["arquivo"]["name"];
    $arquivo_temp = $_FILES["arquivo"]["tmp_name"];

    // Ler o conteúdo do arquivo em formato binário
    $conteudo_arquivo = file_get_contents($arquivo_temp);

    // Obter o ID do usuário da sessão
    session_start();
    $idUsuario = $_SESSION['id_usuario'];

    // Inserir o template no banco de dados
    $sql = "INSERT INTO nequa_template (id_usuario, titulo_template, descricao_template, patch) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("isss", $idUsuario, $titulo, $descricao, $conteudo_arquivo);

    if ($stmt->execute()) {
        echo "<script>alert('Template salvo com sucesso.');</script>";
    } else {
        echo "Erro ao salvar o template: " . $stmt->error;
    }

    $stmt->close();

    // Redirecionar para a página perfil.php
    echo "<script>window.location.href = 'perfil.php';</script>";
}

$conexao->close();
?>
