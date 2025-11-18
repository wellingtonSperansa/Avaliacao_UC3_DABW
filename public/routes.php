<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\CarController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ClientsController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\ServiceOrderController;
use App\Controllers\Admin\SupplierController;
use App\Controllers\Admin\UserController;
use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Middleware\AuthMiddleware;
use Symfony\Component\HttpFoundation\Request;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    // Index Site
    $routeCollector->addGroup('/', function (FastRoute\RouteCollector $site) {
        $site->addRoute('GET', '', [SiteController::class, 'index']);
    });

    // Autenticação
    $routeCollector->addGroup('/auth', function (FastRoute\RouteCollector $auth) {
        $auth->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
        $auth->addRoute('GET', '/create', [AuthController::class, 'create']);
        $auth->addRoute('POST', '/login', [AuthController::class, 'login']);
        $auth->addRoute('POST', '/logout', [AuthController::class, 'logout']);
    });

    $routeCollector->addGroup('/admin', function (FastRoute\RouteCollector $group) {
        // Home Admin
        $group->addGroup('', function (FastRoute\RouteCollector $admin) {
            $admin->addRoute('GET', '', [AdminController::class, 'index']);
        });

        // Produtos
        $group->addGroup('/products', function (FastRoute\RouteCollector $products) {
            $products->addRoute('GET', '', [ProductController::class, 'index']);
            $products->addRoute('GET', '/create', [ProductController::class, 'create']);
            $products->addRoute('POST', '/store', [ProductController::class, 'store']);
            $products->addRoute('GET', '/show', [ProductController::class, 'show']);
            $products->addRoute('GET', '/edit', [ProductController::class, 'edit']);
            $products->addRoute('POST', '/update', [ProductController::class, 'update']);
            $products->addRoute('POST', '/delete', [ProductController::class, 'delete']);
        });
        // Cliente
        $group->addGroup('/clients', function (FastRoute\RouteCollector $clients) {
            $clients->addRoute('GET', '', [ClientsController::class, 'index']);
            $clients->addRoute('GET', '/create', [ClientsController::class, 'create']);
            $clients->addRoute('POST', '/store', [ClientsController::class, 'store']);
            $clients->addRoute('GET', '/show', [ClientsController::class, 'show']);
            $clients->addRoute('GET', '/edit', [ClientsController::class, 'edit']);
            $clients->addRoute('POST', '/update', [ClientsController::class, 'update']);
            $clients->addRoute('POST', '/delete', [ClientsController::class, 'delete']);
        });
        // Carros
        $group->addGroup('/cars', function (FastRoute\RouteCollector $cars) {
            $cars->addRoute('GET', '', [CarController::class, 'index']);
            $cars->addRoute('GET', '/create', [CarController::class, 'create']);
            $cars->addRoute('POST', '/store', [CarController::class, 'store']);
            $cars->addRoute('GET', '/show', [CarController::class, 'show']);
            $cars->addRoute('GET', '/edit', [CarController::class, 'edit']);
            $cars->addRoute('POST', '/update', [CarController::class, 'update']);
            $cars->addRoute('POST', '/delete', [CarController::class, 'delete']);
        });
        // Categorias
        $group->addGroup('/categories', function (FastRoute\RouteCollector $categories) {
            $categories->addRoute('GET', '', [CategoryController::class, 'index']);
            $categories->addRoute('GET', '/create', [CategoryController::class, 'create']);
            $categories->addRoute('POST', '/store', [CategoryController::class, 'store']);
            $categories->addRoute('GET', '/show', [CategoryController::class, 'show']);
            $categories->addRoute('GET', '/edit', [CategoryController::class, 'edit']);
            $categories->addRoute('POST', '/update', [CategoryController::class, 'update']);
            $categories->addRoute('POST', '/delete', [CategoryController::class, 'delete']);
        });

        // Fornecedores
        $group->addGroup('/suppliers', function (FastRoute\RouteCollector $suppliers) {
            $suppliers->addRoute('GET', '', [SupplierController::class, 'index']);
            $suppliers->addRoute('GET', '/create', [SupplierController::class, 'create']);
            $suppliers->addRoute('POST', '/store', [SupplierController::class, 'store']);
            $suppliers->addRoute('GET', '/show', [SupplierController::class, 'show']);
            $suppliers->addRoute('GET', '/edit', [SupplierController::class, 'edit']);
            $suppliers->addRoute('POST', '/update', [SupplierController::class, 'update']);
            $suppliers->addRoute('POST', '/delete', [SupplierController::class, 'delete']);
        });

        // Ordens de Serviço
        $group->addGroup('/service-orders', function (FastRoute\RouteCollector $serviceOrders) {
            $serviceOrders->addRoute('GET', '', [ServiceOrderController::class, 'index']);
            $serviceOrders->addRoute('GET', '/create', [ServiceOrderController::class, 'create']);
            $serviceOrders->addRoute('POST', '/store', [ServiceOrderController::class, 'store']);
            $serviceOrders->addRoute('GET', '/show', [ServiceOrderController::class, 'show']);
            $serviceOrders->addRoute('GET', '/edit', [ServiceOrderController::class, 'edit']);
            $serviceOrders->addRoute('POST', '/update', [ServiceOrderController::class, 'update']);
            $serviceOrders->addRoute('POST', '/delete', [ServiceOrderController::class, 'delete']);
        });

        // Usuários
        $group->addGroup('/users', function (FastRoute\RouteCollector $users) {
            $users->addRoute('GET', '', [UserController::class, 'index']);
            $users->addRoute('GET', '/create', [UserController::class, 'create']);
            $users->addRoute('POST', '/store', [UserController::class, 'store']);
            $users->addRoute('GET', '/show', [UserController::class, 'show']);
//            $users->addRoute('GET', '/edit', [UserController::class, 'edit']);
//            $users->addRoute('POST', '/update', [UserController::class, 'update']);
            $users->addRoute('POST', '/delete', [UserController::class, 'delete']);
        });
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) $uri = substr($uri, 0, $pos);
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
$request = Request::createFromGlobals();

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405';
        break;
    case FastRoute\Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $controller = new $class();

        // Módulos protegidos
        $protectedRoutes = [
            '/admin',
        ];

        // Se a rota começar com alguma dessas, exige login
        foreach ($protectedRoutes as $prefix) {
            if (str_starts_with($uri, $prefix)) {
                $redirect = AuthMiddleware::requireLogin();
                if ($redirect) { $redirect->send(); exit; }
                break;
            }
        }

        $response = $controller->$method($request);
        $response->send();
        break;
}