<?php
namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class PaginaNaoEncontrada implements InterfaceControladorRequisicao {

    public function processaRequisicao(): void
    {
        $titulo = 'Erro 404';
        require __DIR__ . '/../../view/cursos/404.php';
    }
}