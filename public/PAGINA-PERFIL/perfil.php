<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: ../../LOGIN/index.html');
    exit;
}

// Obtém os dados do usuário da sessão
$nomeUsuario = $_SESSION['nome_usuario'];

// Conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "nequa01";

$conexao = new mysqli($host, $usuario, $senha, $banco);
if ($conexao->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conexao->connect_error);
}

// Consultar o e-mail do usuário no banco de dados
$sql = "SELECT email FROM nequa_cadastrop WHERE nome = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $nomeUsuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $emailUsuario = $row['email'];
} else {
    // E-mail do usuário não encontrado no banco de dados
    // Trate o caso de erro aqui
}

$stmt->close();
$conexao->close();

$contadorArquivo = 'contador.txt';

// Verifica se o arquivo existe; se não, cria-o com o valor 0
if (!file_exists($contadorArquivo)) {
    file_put_contents($contadorArquivo, '0');
}

// Lê o valor atual do contador a partir do arquivo
$contador = intval(file_get_contents($contadorArquivo));

// Incrementa o contador
$contador++;

// Atualiza o arquivo com o novo valor do contador
file_put_contents($contadorArquivo, $contador);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="index.css">
    <script src="app.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<!--
    <header>
        <div class="logo-container">
            <img src="" class="logo" alt="Logo">
        </div>

        <div class="flex-header-elements">
            <a href="">TESTE 1</a>
            <a href="">TESTE 2</a>
            <a href="">TESTE 3</a>
            <a href="">TESTE 4</a>
        </div>
    </header>
-->
    <main>
        <div class="banner-background">
            <input type="file" name="banner" id="banner">
        </div>
        
        <div class="profile-header">
            <input type="file" id="changeProfilePic">
        </div>
        

        <div class="information">
            <h3><?php echo $nomeUsuario; ?></h3>
            <h4><?php echo $emailUsuario; ?></h4>
        </div>

        <a href="#popup">Adicione áreas de atuação</a>

        <p>Numero de visitas no perfil<?php echo $contador; ?></p>

        <div class="buttons-profile-templates">
            <button class="profile" id="profile" onclick="changeContent(1)">Perfil</button>
            <button class="templates" id="templates" onclick="changeContent(2)">Templates</button>
        </div>

    </main>

    <main class="content" id="content">
        <div id="profile-content" class="profile-content">
            <div class="card-profile">
                <h2 class="about-username">Sobre <span class="userName">Ronaldinho</span></h2>
                <hr width="80%" color="lightgray">

                <div class="change-profile-information">
                    <label for="changeUsername">Usuário:</label>
                    <input type="text" id="changeUsername" placeholder="" maxlength="30"><br><br>
                    <label for="changeName">Nome:</label>
                    <input type="text" id="changeName" maxlength="80"><br><br>
                    <div class="social-media">
                        <h4>Redes Sociais</h4>
                        <label for="instagram">Instagram</label>
                        <input type="url" id="instagram"><br>

                        <label for="twitter">Twitter</label>
                        <input type="url" id="twitter"><br>

                        <label for="linkedin">Linkedin</label>
                        <input type="url" id="linkedin">
                    </div><br>
                    <label for="">Biografia:</label><br>
                    <textarea name="biografia" id="biografia" cols="30" rows="10"></textarea>
                    
                </div>
            </div> 
        </div>

        <div id="template-content" class="template-content">
            <button class="create" id="open-popup">Criar</button>

            <div class="popup-overlay" id="popupSaveArchive">
                <div class="popup-content">
                <button class="popup-close" id="close-popup">&times;</button>
                    <h2>Novo Template</h2>
                    <form class="popup-form" action="salvar_template.php" method="post" enctype="multipart/form-data">
                    
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" id="titulo" required>
        
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" rows="4" required></textarea>
        
                        <label for="arquivo">Arquivo:</label>
                        <input type="file" name="arquivo" id="arquivo">
        
                        <span id="file-name"></span><br><br>
        
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            </div>

            <div class="templates">
                <?php include "buscar_templates.php"; ?>
            </div>
            
        </div>

        <div class="nada"></div>
    </main>


    <div id="popup" class="overlay">
        <div class="popup">
          <h4 id="TESTE"></h4>
          <a class="close" href="#POPUP-HOVER">&times;</a>
          <div class="content1">
            <h3>Front-End</h3>
                <button class="sections">Figma</button>
                <button class="sections">HTML</button>
                <button class="sections">CSS</button>
                <button class="sections">JS</button>
                <hr>
            <h3>Frameworks</h3>
            <button class="sections">Bootstrap</button>
            <button class="sections">Tailwind</button>
            <button class="sections">React</button>
            <button class="sections">Vue</button>
          </div>
        </div>
      </div>
</body>
</html>