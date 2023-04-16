<?php
    require __DIR__ . "/inc/bootstrap.php";
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
    if ((isset($uri[3]) && $uri[3] != 'animals')) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

    require PROJECT_ROOT_PATH . "/Controller/Api/AnimalController.php";
    $controller = new AnimalController();
    $controller->handleRequest();
?>
    
