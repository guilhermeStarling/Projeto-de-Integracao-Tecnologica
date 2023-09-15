<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $novaSenha = $_POST["novaSenha"];
    $confirmarSenha = $_POST["confirmarSenha"];
    $tipoUsuario = $_POST["tipoUsuario"];
    $email = $_POST["email"];

    // Validar as senhas
    if ($novaSenha !== $confirmarSenha) {
        $erro = "A nova senha e a confirmação de senha não coincidem.";
    } else {
        // Conectar ao banco de dados
        $servidor = "localhost";
        $usuarioBD = "root";
        $senhaBD = "";
        $banco = "nequa01";

        $conexao = mysqli_connect($servidor, $usuarioBD, $senhaBD, $banco);
        if (mysqli_connect_errno()) {
            die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
        }

        // Verificar o tipo de usuário e selecionar a tabela correta
        if ($tipoUsuario === "cadastrop") {
            $tabela = "nequa_cadastrop";
        } elseif ($tipoUsuario === "cadastroE") {
            $tabela = "nequa_cadastroE";
        } else {
            die("Tipo de usuário inválido.");
        }

        // Verificar a existência do usuário no banco de dados
        $sql = "SELECT id FROM $tabela WHERE email = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Atualizar a senha no banco de dados
            $sql = "UPDATE $tabela SET senha = ? WHERE email = ?";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $novaSenha, $email);
            mysqli_stmt_execute($stmt);

            echo "Senha alterada com sucesso.";
        } else {
            $erro = "Usuário não encontrado no banco de dados.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alterar Senha</title>
    <style>
        .error {
            color: red;
        }

        body {
            text-align: center;
        }

        body form {
            text-align: center;
            margin-top: 20px;
        }

        .logo {
            width: 200px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 400px;
            margin: auto;
        }

        input {
            padding: 5px 8px;
        }

        .glow-on-hover {
        width: 220px;
        height: 40px;
        border: none;
        outline: none;
        color: #fff;
        background: #3E69AA;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 30px;
        margin-left: 85px;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left:-2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 30px;
    }

    .glow-on-hover:active {
        color: white;
    }

    .glow-on-hover:active:after {
        background: transparent;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    .glow-on-hover:after {
        z-index: -1;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #3E69AA;
        left: 0;
        top: 0;
        border-radius: 30px;
    }

    @keyframes glowing {
        0% { background-position: 0 0; }
        50% { background-position: 400% 0; }
        100% { background-position: 0 0; }
    }
    </style>
</head>
<body>
    <h2>Alterar Senha</h2>

    <?php if (isset($erro)) : ?>
        <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>

    <img src="IMAGES/nequa-removebg-preview (1).png" class="logo">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="tipoUsuario">Tipo de Usuário:</label>
        <select name="tipoUsuario" required>
            <option value="cadastrop">Pessoa</option>
            <option value="cadastroE">Empresa</option>
        </select><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="novaSenha">Nova Senha:</label>
        <input type="password" name="novaSenha" required><br>

        <label for="confirmarSenha">Confirmar Senha:</label>
        <input type="password" name="confirmarSenha" required><br>

        <button class="glow-on-hover" type="submit">Alterar Senha</button>
    </form>
</body>
</html>
