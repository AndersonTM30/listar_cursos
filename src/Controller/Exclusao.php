<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Exclusao implements InterfaceControladorRequisicao {
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        // filtra e valida o id do curso no parâmetro da rota
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        // verifica se a rota está com o id nulo ou vazio, se tiver vai voltar para a página de listar cursos
        if (is_null($id) || $id === false) {
            header('Location: /listar-cursos');
            return;
        }
        // localiza o id do curso
        $curso = $this->entityManager->getReference(Curso::class, $id);
        // efetua a exclusão do curso
        $this->entityManager->remove($curso);
        // manda as alterações para o banco de dados
        $this->entityManager->flush();
        // redireciona para a tela de listar cursos depois de excluir o curso
        header('Location: /listar-cursos');
    }
}