<?php
require_once 'vendor/autoload.php';

function render(string $template, array $vars = [])
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render($template . '.twig', $vars);
}

$router = new AltoRouter();

$router->map('GET', '/', function () {
    render('index', ['session' => ['username' => 'johncar96']]);
});

$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    render('errors/404');
}
