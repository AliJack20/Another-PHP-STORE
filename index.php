<?php

// Database connection
require_once 'dbcon.php'; // adjust path if needed

// Controller and action from URL
$controller = $_GET['controller'] ?? 'Auth'; // default = product
$action = $_GET['action'] ?? 'index';           // default = index

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controller/' . $controllerName . '.php';

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
