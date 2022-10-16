<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
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
        
        // montar o modelo curos
        $curso = new Curso();
        $curso->setDescricao($descricao);
        // inserir no banco de dados
        $this->entityManager->persist($curso);
        $this->entityManager->flush();
    }
}