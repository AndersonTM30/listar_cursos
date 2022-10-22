<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessagemTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface {
    //utilizando traits para envio de mensagem
    use FlashMessagemTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // filtra e valida o id do curso no parâmetro da rota
        $id = filter_var(
            $request->getQueryParams()['id'], FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/listar-curso']);
        // verifica se a rota está com o id nulo ou vazio, se tiver vai voltar para a página de listar cursos
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Curso inexistente!');
            // header('Location: /listar-cursos');
            return $resposta;
        }
        // localiza o id do curso
        $curso = $this->entityManager->getReference(Curso::class, $id);
        // efetua a exclusão do curso
        $this->entityManager->remove($curso);
        // manda as alterações para o banco de dados
        $this->entityManager->flush();

        $this->defineMensagem('success', 'Curso removido com sucesso!');

        // redireciona para a tela de listar cursos depois de excluir o curso
       return $resposta;
    }
}