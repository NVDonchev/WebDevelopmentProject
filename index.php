<?php 

define("DS", "/");
define("APP_DIR_NAME", basename(dirname(__FILE__)));
define("PATH_TO_APP", $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR_NAME.DS);

include "lib".DS."Router.php";

// TODO get route data
// Determine which controller should be invoked based on the URL and Route configuration
$routeConfig = include "config".DS."routes.php";
$route = Router::parseUri($_SERVER['REQUEST_URI']);

echo "Parsed route: \n";
print_r($route);

$controllersDir = isset($route['area']) ? "areas".DS.$route['area'].DS."controllers".DS : "controllers".DS;
$controllerFilePath = $controllersDir.$route['controller'].".php";

include $controllerFilePath;

$controllerInstance = new $route['controller']();
call_user_method($route['method'], $controllerInstance);

// Render view

?>