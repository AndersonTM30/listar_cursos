<?php

    require __DIR__ . '/../vendor/autoload.php';

    // importação de classes
    use Nyholm\Psr17\Factory\Psr17Factory;
    use Nyholm\Psr17Server\ServerRequestCreator;
    use Psr\Container\ContainerInterface;
    use Psr\Http\Server\RequestHandlerInterface;

    $caminho = $_SERVER['PATH_INFO'];//caminho da rota
    $rotas = require __DIR__ . '/../config/routes.php';// array das rotas

    // verifica se a rota existe
    if(!array_key_exists($caminho, $rotas)) {
        header('Location: /404', true, 302);
    };

    //inicia a sessão
    session_start();
    //verifica se na string tem a palavra login
    $ehRotaDeLogin = str_contains($caminho, 'login');
    if (!isset($_SESSION['logado']) && !$ehRotaDeLogin) {
        header('Location: /login');
        // exit();
    }

    $psr17Factory = new Psr17Factory();

    $creator = new ServerRequestCreator(
        $psr17Factory, // ServerRequestFactory
        $psr17Factory, // UriFactory
        $psr17Factory, // UploadedFileFactory
        $psr17Factory  // StreamFactory
    );

    $serverRequest = $creator->formGlobals();
    $classeControladora = $rotas[$caminho];
    /** @var ContainerInterface $container */
    $classeControladora = require __DIR__ . "/../config/denpendecies.php";
    /** @var RequestHandlerInterface $controlador */
    $controlador = $controlador->get($classeControladora);

    $resposta = $controlador->handle($serverRequest);

foreach($resposta->getHeaders() as $name=>$value) {
    foreach($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $reposta->getBody();
