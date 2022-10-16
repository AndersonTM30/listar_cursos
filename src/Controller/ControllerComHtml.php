<?php

namespace Alura\Cursos\Controller;

abstract class ControllerComHtml {

    public function renderizaHtml(string $caminhoTemplate, array $dados): string {
        // extrai dados do array
        extract($dados);
        // armazena o html em uma variável com a função de buffer
        ob_start();
        // cria um caminho template para ser reutilizado em outros controladores
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        $html = ob_get_clean();

        return $html;
    }
}