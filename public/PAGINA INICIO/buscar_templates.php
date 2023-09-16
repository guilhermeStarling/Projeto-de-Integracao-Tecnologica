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

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['id_usuario'];

// Consultar os templates salvos no banco de dados pelo usuário logado
$sql = "SELECT * FROM nequa_template WHERE id_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo '<div class="templates">';
    // Exibir os templates na div
    while ($row = $resultado->fetch_assoc()) {
        echo "<div class='template'>";
        echo "<h3>" . $row["titulo_template"] . "</h3>";
        echo "<p>" . $row["descricao_template"] . "</p>";
        // Exibir o arquivo
        echo "<a href='data:application/octet-stream;base64," . base64_encode($row["patch"]) . "' download='" . $row["titulo_template"] . ".html'>Download</a>";
        echo "</div>";
    }
    echo '</div>';
} else {
    echo "Nenhum template encontrado.";
}

$stmt->close();
$conexao->close();
?>
