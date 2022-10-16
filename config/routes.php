<?php

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\PaginaNaoEncontrada;
use Alura\Cursos\Controller\Persistencia;
//  lista de rotas
return [
    '/listar-cursos'    =>  ListarCursos::class,
    '/novo-curso'       =>  FormularioInsercao::class,
    '/salvar-curso'     =>  Persistencia::class,
    '/404'              =>  PaginaNaoEncontrada::class
];
