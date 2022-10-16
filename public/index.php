<?php

    require __DIR__ . '/../vendor/autoload.php';

    // importação de classes
    use Alura\Cursos\Controller\InterfaceControladorRequisicao;

    $caminho = $_SERVER['PATH_INFO'];//caminho da rota
    $rotas = require __DIR__ . '/../config/routes.php';// array das rotas

    // verifica se a rota existe
    if(!array_key_exists($caminho, $rotas)) {
        http_response_code(404);
        exit();
    };

    $classeControladora = $rotas[$caminho];
    /** @var InterfaceControladorRequisicao $controler */
    $controlador = new $classeControladora();// cria uma classe controladora
    $controlador->processaRequisicao();
