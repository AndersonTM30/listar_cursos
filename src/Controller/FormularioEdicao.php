<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessagemTrait;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormularioEdicao implements InterfaceControladorRequisicao {
    
    use RenderizadorDeHtmlTrait, FlashMessagemTrait;

    private $repositorioCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
      $this->repositorioCursos = $entityManager
        ->getRepository(Curso::class);
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        // filtra e valida o id do curso no parâmetro da rota
        $id = filter_var(
            $request->getQueryParams()['id'], FILTER_VALIDATE_INT
        );
        // verifica se a rota está com o id nulo ou vazio, se tiver vai voltar para a página de listar cursos
        $resposta = new Response(302, ['Location' => '/listar-cursos']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID do curso inválido!');
            return $resposta;
        }
        // localiza o id do curso
        $curso = $this->repositorioCursos->find($id);

        $html =  $this->renderizaHtml('cursos/formulario.php', [
            'curso'=> $curso,
            'titulo'=> 'Alterar Curso ' . $curso->getDescricao()
        ]);

        return new Response(200, [], $html);

    }
}