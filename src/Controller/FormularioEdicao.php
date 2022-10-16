<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator as InfraEntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao {

    public function __construct()
    {
        $entityManager = (new InfraEntityManagerCreator)
            ->getEntityManager();    
        $this->repositorioCursos = $entityManager
            ->getRepository(Curso::class);
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
        $curso = $this->repositorioCursos->find($id);
        $titulo = 'Alterar Curso ' . $curso->getDescricao();
        require __DIR__ . '/../../view/cursos/formulario.php';
    }
}