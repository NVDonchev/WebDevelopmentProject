<?php 

define("DS", DIRECTORY_SEPARATOR);
define("APP_DIR_NAME", basename(dirname(__FILE__)));

include "lib".DS."Router.php";




// TODO get route data
// Determine which controller should be invoked based on the URL and Route configuration
$routeConfig = include "..".DS."config".DS."routes.php";
$route = Router::parseUri($_SERVER['REQUEST_URI']);

echo "Parsed route: \n";
print_r($route);

$controllersDir = $route['area'] ? "areas".DS.$route['area'].DS."controllers".DS : "controllers".DS;
$controllerFilePath = $controllersDir.DS.$route['controller'].".php";

include $controllerFilePath;

$controllerInstance = new $route['controller']();
call_user_method($route['method'], $controllerInstance);

// Render view

?>