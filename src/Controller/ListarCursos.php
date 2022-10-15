<?php
    // export da classe de listar cursos
    namespace Alura\Cursos\Controller;
    // imports das classes de Curso e da Entidade do banco de dados
    use Alura\Cursos\Infra\EntityManagerCreator;
    use Alura\Cursos\Entity\Curso;
    // Classe controladora e listagem de cursos
    class ListarCursos implements InterfaceControladorRequisicao {
        private $repositorioDeCursos;

        public function __construct()
        {
            $entityManager = (new EntityManagerCreator())->getEntityManager();
            $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        }
        // método que vai listar os cursos
        public function processaRequisicao(): void {
            
            $cursos = $this->repositorioDeCursos->findAll();
            require __DIR__ . '/../../view/cursos/listar-cursos.php';
        }
    }