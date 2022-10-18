<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessagemTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessagemTrait;

    private $entityManager;

    public function __construct()
    {
        // Inicializa a comunicação com a entidade do banco de dados
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        // filtrando os dados da requisição e pegar os dados do formulário
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

         // filtra e valida o id do curso no parâmetro da rota
         $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        $tipo = 'success';
        // verifica se a rota está com o id nulo ou vazio, se tiver vai voltar para a página de listar cursos
        if (!is_null($id) && $id !== false) {
            $curso = $this->entityManager->find(Curso::class, $id);
            $curso->setDescricao($descricao);
            $this->defineMensagem($tipo, 'Curso atualizado com sucesso!');
        } else {
            // montar o modelo curos
            $curso = new Curso();
            $curso->setDescricao($descricao);
            // inserir no banco de dados
            $this->entityManager->persist($curso);
            $this->defineMensagem($tipo, 'Curso inserido com sucesso!');
        }

        $this->entityManager->flush();     
        // fazendo o redirecionamento para página de listar cursos
        header('Location: /listar-cursos', true, 302);
    }
}