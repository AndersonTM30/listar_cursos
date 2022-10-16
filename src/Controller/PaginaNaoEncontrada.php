<?php
namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class PaginaNaoEncontrada extends ControllerComHtml implements InterfaceControladorRequisicao {

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/404.php', [
            'titulo' => 'Erro 404'
        ]);
    }
}