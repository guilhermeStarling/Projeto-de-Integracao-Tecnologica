<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: LOGIN/index.html');
    exit;
}

// Obtém o nome de usuário da sessão
$nomeUsuario = $_SESSION['nome_usuario'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css_inicio.css">
    <title>Nequa</title>
 </head>
  <body>
    <div class="page-header">
      <div class="logo">
        <img src="nequa-removebg-preview.png" class="logo-logo">
      </div>
      <a id="menu-icon" class="menu-icon" onclick="onMenuClick()">
        <i class="fa fa-bars"></i>
      </a>

      <div id="navigation-bar" class="nav-bar">
        <a href="#" class="active">Inicio</a>
        <a href="#">Sobre</a>
        <a href="#">Projetos</a>
      </div>

      <div class="header-right"><button>Sign in</button></div>
    </div>

    <div class="sec-1">
        <div>
            <h1 class="titulo-sec1">Nequa</h1>
        </div>

        <div>
            <form method="get" action="/search" id="search">
                <input name="q" type="text" size="40" placeholder="Search..." />
              </form>
        </div>
    </div>

    <hr>

        <div class="sec-2">
            <div>
                <h2 class="titulo-sec2">Usuários Mais Influentes</h2>
            </div>    
            <div id="perfil" class="btns-perfil">
            <a href="perfil.php">Ir para o Perfil do Usuário</a>
                <button class="perf" href="#"></button>
                <button class="perf" href="#"></button>
                <button class="perf" href="#"></button>
                <button class="perf" href="#"></button>
                <button class="perf" href="#"></button>
                <button class="perf" href="#"></button>
              </div>
        </div>

        <hr>

        <div class="sec-3">
            <div>
                <h3 class="titulo-sec3" id="templates">Templates Mais Vendidos</h3>
            </div> 
            <div id="templates-mais" class="btns-templates">
                <button class="temp" href="#"></button>
                <button class="temp" href="#"></button>
                <button class="temp" href="#"></button>
              </div>
        </div>

        <footer>
          <p>©2023 Nequa. Todos os direitos reservados.</p>
        </footer>
  </body>
</html>