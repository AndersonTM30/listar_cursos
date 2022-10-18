<?php
    // export da classe de listar cursos
    namespace Alura\Cursos\Controller;
    // imports das classes de Curso e da Entidade do banco de dados
    use Alura\Cursos\Infra\EntityManagerCreator;
    use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

    // Classe controladora e listagem de cursos
    class ListarCursos implements InterfaceControladorRequisicao {

        use RenderizadorDeHtmlTrait;

        private $repositorioDeCursos;

        public function __construct()
        {
            $entityManager = (new EntityManagerCreator())->getEntityManager();
            $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        }
        // método que vai listar os cursos
        public function processaRequisicao(): void {
            echo $this->renderizaHtml('cursos/listar-cursos.php', [
                'cursos' => $this->repositorioDeCursos->findAll(),
                'titulo' => 'Lista de Cursos'
            ]);
        }
    }