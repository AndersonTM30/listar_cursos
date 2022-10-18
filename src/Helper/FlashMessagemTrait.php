<?php

namespace Alura\Cursos\Helper;

trait FlashMessagemTrait
{
    public function defineMensagem(string $tipo, string $mensagem): void
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;

    }
}