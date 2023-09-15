<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nequa01";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

function formatTelefone($telefone) {
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    $ddd = substr($telefone, 0, 2);
    $numero = substr($telefone, 2, 5) . "-" . substr($telefone, 7);
    return "($ddd) $numero";
}

function formatCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9);
    return $cpf;
}

function isSenhaValida($senha) {
    // Verifica se a senha atende aos requisitos
    if (strlen($senha) < 8 || strlen($senha) > 16) {
        return false;
    }

    // Verifica se a senha contém letras, números e caracteres especiais
    if (!preg_match('/[A-Za-z]/', $senha) || !preg_match('/[0-9]/', $senha) || !preg_match('/[^A-Za-z0-9]/', $senha)) {
        return false;
    }

    return true;
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$sexo = $_POST['sexo'];
$data_nasc = $_POST['data_nasc'];
$cidade = strtoupper($_POST['cidade']);
$estado = strtoupper($_POST['estado']);
$endereco = strtoupper($_POST['endereco']);
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmar_senha'];

// Formatação do telefone
$telefone = formatTelefone($telefone);

// Formatação do CPF
$cpf = formatCPF($cpf);

if ($senha === $email) {
    echo "A senha não pode ser igual ao e-mail.";
    exit;
}

// Verificação da senha
if ($senha !== $confirmarSenha) {
    echo "As senhas não coincidem.";
    exit;
}

if (!isSenhaValida($senha)) {
    echo "A senha deve conter entre 8 e 16 caracteres, contendo letras, números e caracteres especiais.";
    exit;
}

$sql = "INSERT INTO nequa_cadastrop (nome, email, telefone, sexo, data_nasc, cidade, estado, endereco, cpf, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $nome, $email, $telefone, $sexo, $data_nasc, $cidade, $estado, $endereco, $cpf, $senha);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../../LOGIN/index.html");
exit();

?>

