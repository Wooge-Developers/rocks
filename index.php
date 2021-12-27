<?php
require_once 'vendor/autoload.php';
require 'db.php';

function render(string $template, array $vars = [])
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render($template . '.twig', $vars);
}

$router = new AltoRouter();
// $db = new db();

$metadata = [
    "user_context" => [
        "files_served" => 0,
        "sites_on_site" => 0.
    ],
];


$router->map('GET', '/', function () {
    render('index', ['session' => ['username' => 'johncar96']]);

});

$router->map('GET', '/login', function () {
    render('login', ['session' => ['username' => 'johncar96']]);
});

$router->map('GET', '/upload', function () {
    render('new_file', ['session' => ['username' => 'johncar96']]);
});

$router->map('GET', '/logout', function () {
    render('logout', ['session' => ['username' => 'johncar96']]);
});


$router->map('GET', '/edit_file', function () {
    render('edit_file', ['session' => ['username' => 'johncar96']]);
});

$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    render('errors/404');
}


