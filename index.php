<?php 

define("DS", "/");
define("APP_DIR_NAME", basename(dirname(__FILE__)));
define("PATH_TO_APP", $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR_NAME.DS);

include "lib".DS."Router.php";
include "lib".DS."View.php";
include "lib".DS."AnnotationHelper.php";

// get route data
$routeConfig = include "config".DS."routes.php";
$route = Router::parseUri($_SERVER['REQUEST_URI']);

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

// bind Post model
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $reflection = new ReflectionMethod($controllerInstance, $route['method']);
    $param = $reflection->getParameters()[0];

    $bindingClassName = $param->getClass();
    $bindingClassInstance = new $bindingClassName->name();

    $reflection = new ReflectionClass($bindingClassName->name);
    foreach ($reflection->getProperties() as $prop) {
        $propertyName = $prop->getName();

        foreach ($_POST as $name => $value) {
            if ($name === $propertyName) {
                $bindingClassInstance->$propertyName = $value;
                break;
            }
        }
    }

    $actionResult = call_user_func_array(array($controllerInstance, $route['method']), array($bindingClassInstance));
}
else {
    $actionResult = call_user_func_array(array($controllerInstance, $route['method']), array(new HelloBindingModel()));
}

// render view
if (get_class($actionResult) === "View") {
    $view = get_class($actionResult);

    $viewPath = null;
    if (isset($actionResult->viewName)) {
        $view = $actionResult->viewName.".php";
        $viewPath = PATH_TO_APP."views".DS.$actionResult->viewName.".php";
    }
    else {
        $view = str_ireplace("Controller", "", $route['controller']).".php";
        $viewPath = PATH_TO_APP."views".DS.$view;
    }

    $expectedViewModel = explode("/", AnnotationHelper::getViewModelType($viewPath))[1];

    if (get_class($actionResult->model) !== $expectedViewModel) {
        die ("The view '" . explode(".", $view)[0] . "' expects a " . $expectedViewModel . " view model.
        The actual one is " . get_class($actionResult->model). ".");
    }

    $actionResult->render($view);
}
?>