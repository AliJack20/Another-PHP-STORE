<?php
// Database connection
require_once 'dbcon.php'; 

// Controller and action from URL
$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'index';          

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controller/' . $controllerName . '.php';

if ($_GET['controller'] == 'product' && $_GET['action'] == 'search') {
    require_once 'dbcon.php';
    require_once 'controller/ProductController.php';

    require_once 'dbcon.php';
    $controller = new ProductController();
    $searchTerm = $_GET['search'] ?? '';
    $products = $controller->search($conn, $searchTerm);

    require_once 'view/products/index.php';
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controllerObject = new $controllerName();

        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            echo "❌ Action '$action' not found in $controllerName";
        }
    } else {
        echo "❌ Class '$controllerName' not found.";
    }
} else {
    echo "❌ Controller file '$controllerFile' not found.";
}
