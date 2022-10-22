<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursoEmJson implements RequestHandlerInterface
{
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        return new Response(200, [], json_encode($cursos));
    }
}