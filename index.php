<?php 

define("DS", "/");
define("APP_DIR_NAME", basename(dirname(__FILE__)));
define("PATH_TO_APP", $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR_NAME.DS);

include "lib".DS."Router.php";
include "lib".DS."View.php";

// get route data
$routeConfig = include "config".DS."routes.php";
$route = Router::parseUri($_SERVER['REQUEST_URI']);

echo "Parsed route: \n";
print_r($route);

// determine which controller should be invoked based on the URL and Route configuration
$controllersDir = isset($route['area']) ? "areas".DS.$route['area'].DS."controllers".DS : "controllers".DS;
$controllerFilePath = $controllersDir.$route['controller'].".php";

if (file_exists($controllerFilePath)) {
    include $controllerFilePath;
}
else {
    die("<h2>No such controller found: <i>" . $controllerFilePath . "</i></h2>");
}

$controllerInstance = new $route['controller']();
$actionResult = call_user_func(array($controllerInstance, $route['method']));

// Render view
if (get_class($actionResult) === "View") {
    $view = str_ireplace("Controller", "", $route['controller']).".php";
    $actionResult->render($view);
}
?>