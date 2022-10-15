<?php
    // export da classe de listar cursos
    namespace Alura\Cursos\Controller;
    // imports das classes de Curso e da Entidade do banco de dados
    use Alura\Cursos\Infra\EntityManagerCreator;
    use Alura\Cursos\Entity\Curso;
    // Classe controladora e listagem de cursos
    class ListarCursos {
        private $repositorioDeCursos;

        public function __construct()
        {
            $entityManager = (new EntityManagerCreator())->getEntityManager();
            $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        }
        // método que vai listar os cursos
        public function processaRequisicao() {
            
            $cursos = $this->repositorioDeCursos->findAll();
            ?><!-- Forma não recomendada de juntar html com php -->
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <title>Document</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
            <body>
            <div class="container">
                <div class="jumbotron">
                    <h1>Listar cursos</h1>
                </div>
                <a href="/novo-curso" class="btn btn-primary mb-2">Novo Curso</a>
                <ul class="list-group">
                    <?php foreach ($cursos as $curso): ?>
                        <li class="list-group-item">
                            <?= $curso->getDescricao(); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            </body>
            </html>
            <?php
        }
    }