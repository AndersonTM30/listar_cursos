<?php
    // redirecionamento de páginas
    switch($_SERVER['PATH_INFO']) {
        case '/listar-cursos':
            require 'listar-cursos.php';
            break;
        case '/novo-curso': 
            require 'formulario-novo-curso.php';
            break;
        default:
            echo "Página não encontrada, Erro 404";
    }