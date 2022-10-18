<?php
namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class PaginaNaoEncontrada implements InterfaceControladorRequisicao {

    use RenderizadorDeHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/404.php', [
            'titulo' => 'Erro 404'
        ]);
    }
}