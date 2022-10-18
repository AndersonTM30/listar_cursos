<?php

    require __DIR__ . '/../vendor/autoload.php';

    // importação de classes
    use Alura\Cursos\Controller\InterfaceControladorRequisicao;

    $caminho = $_SERVER['PATH_INFO'];//caminho da rota
    $rotas = require __DIR__ . '/../config/routes.php';// array das rotas

    // verifica se a rota existe
    if(!array_key_exists($caminho, $rotas)) {
        header('Location: /404', true, 302);
    };

    //inicia a sessão
    session_start();
    //verifica se na string tem a palavra login
    $ehRotaDeLogin = str_contains($caminho, 'login');
    if (!isset($_SESSION['logado']) && !$ehRotaDeLogin) {
        header('Location: /login');
        // exit();
    }

    $classeControladora = $rotas[$caminho];
    /** @var InterfaceControladorRequisicao $controler */
    $controlador = new $classeControladora();// cria uma classe controladora
    $controlador->processaRequisicao();
