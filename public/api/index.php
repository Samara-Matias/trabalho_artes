<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\NotFoundException;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;


require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath('/api');

// ESSENCIAL para roteamento funcionar
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->add(function (Request $request, RequestHandlerInterface $handler) use ($app): Response {
    if ($request->getMethod() === 'OPTIONS') {
        $response = $app->getResponseFactory()->createResponse();
    } else {
        $response = $handler->handle($request);
    }

    $response = $response
        ->withHeader('Access-Control-Allow-Credentials', 'true')
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->withHeader('Pragma', 'no-cache');

    if (ob_get_contents()) {
        ob_clean();
    }

    return $response;
});

$app->get('/', function (Request $request, Response $response) {
    $file = '../app/views/home.view.php';
    if (file_exists($file)) {
        return $response->getBody()->write(file_get_contents($file));
    }
});

$app->get('/teste', function (Request $request, Response $response) {
    $data = array('name' => 'Pinacudo', 'age' => 40);
    $payload = json_encode($data);
    $response->getBody()->write($payload);
    $resp =  $response->withHeader('Content-type', 'application/json');
    return $resp;
});
$app->run();
