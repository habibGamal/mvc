<?php
    require_once __DIR__.'/vendor/autoload.php';

    use app\core\Application;

    $app = new Application();

    $app->router->get('/',function (){
        echo 'main page';
    });
    $app->router->get('/about',function (){
        echo 'about page';
    });
    $app->router->get('/info',function (){
        echo 'info page';
    });
    $app->router->get('/contact',function (){
        echo 'contact page';
    });

    $app->run();