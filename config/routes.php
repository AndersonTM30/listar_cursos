<?php

use Alura\Cursos\Controller\CursoEmJson;
use Alura\Cursos\Controller\CursosEmXml;
use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\FormularioEdicao;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\FormularioLogin;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\PaginaNaoEncontrada;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\RealizaLogin;

//  lista de rotas
return [
    '/listar-cursos'        =>  ListarCursos::class,
    '/novo-curso'           =>  FormularioInsercao::class,
    '/salvar-curso'         =>  Persistencia::class,
    '/404'                  =>  PaginaNaoEncontrada::class,
    '/excluir-curso'        =>  Exclusao::class,
    '/alterar-curso'        =>  FormularioEdicao::class,
    '/login'                =>  FormularioLogin::class,
    '/realiza-login'        =>  RealizaLogin::class,
    '/logout'               =>  Deslogar::class,
    '/buscarCursosEmJson'   => CursoEmJson::class,
    '/buscarCursosEmXml'    => CursosEmXml::class
];
