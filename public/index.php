<?php
    use app\controllers\AuthController;
    use app\controllers\SiteController;
    use app\core\Application;
    use app\Utility as u;
    function show($var){
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
    require_once __DIR__.'/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
    
    $config = [
        'db' => [
            'dsn' => $_ENV['DB_DSN'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
        ]
    ];
    $app = new Application(dirname(__DIR__) ,$config);

    $app->router->get('/', [SiteController::class , 'home']);
    $app->router->get('/about',function (){
        echo 'about page';
    });
    $app->router->get('/info',function (){
        echo 'info page';
    });
    $app->router->get('/contact',[SiteController::class , 'contact']);
    $app->router->post('/contact',[SiteController::class , 'handleContact']);

    $app->router->get('/login', [AuthController::class , 'login']);
    $app->router->post('/login', [AuthController::class , 'login']);
    $app->router->get('/register', [AuthController::class , 'register']);
    $app->router->post('/register', [AuthController::class , 'register']);
    $app->run();