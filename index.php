<?php

use App\Controllers\ProductController;
use App\Redirect;
use App\Repositories\PDOProductRepository;
use App\Repositories\ProductRepository;
use App\Views\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ProductRepository::class => DI\create(PDOProductRepository::class)
]);

$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [ProductController::class, 'index']);
    $r->addRoute('GET', '/add-product', [ProductController::class, 'create']);
    $r->addRoute('POST', '/add-product', [ProductController::class, 'listTypes']);
    $r->addRoute('POST', '/add-product/store', [ProductController::class, 'store']);
    $r->addRoute('POST', '/delete', [ProductController::class, 'delete']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $response = $container->get($controller)->$method($routeInfo[2]);
        $twig = new Environment(new FilesystemLoader('app/Views'));

        if ($response instanceof View) {
            echo $twig->render($response->getPath() . '.html', $response->getVariables());
        }

        if ($response instanceof Redirect) {
            header('Location: ' . $response->getLocation());
            exit;
        }
        break;
}
