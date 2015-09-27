<?php 

define("DS", "/");
define("APP_DIR_NAME", basename(dirname(__FILE__)));
define("PATH_TO_APP", $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR_NAME.DS);

// includes
include('config/database.php');

include "lib".DS."Router.php";
include "lib".DS."View.php";
include "lib".DS."AnnotationHelper.php";

include "lib".DS."htmlRender.php";

include "controllers".DS."baseController.php";

include "models".DS."product.php";
include "models".DS."user.php";

include "bindingModels".DS."filterByCategoryBindingModel.php";
include "bindingModels".DS."buyProductBindingModel.php";

session_start();

if (!isset($_SESSION["products"])) {
    $_SESSION["products"] = array(
        new Product(1, "Microwave", 110, "kitchen", 5),
        new Product(2, "Toaster", 340, "kitchen", 5),
        new Product(3, "Refrigerator", 700, "electronics", 3),
        new Product(4, "Washing Machine", 340, "kitchen", 5),
        new Product(5, "Sofa", 160, "furniture", 1),
        new Product(6, "Television", 1200, "electronics", 7),
        new Product(7, "Chair", 20, "furniture", 0),
        new Product(8, "Oven", 130, "kitchen", 5),
        new Product(9, "PlayStation 4", 800, "electronics", 3),
        new Product(10, "Bed", 300, "furniture", 2),
        new Product(11, "Baked Potato", 1, "food", 3),
        new Product(12, "Table", 39, "furniture", 0),
        new Product(13, "Speakers", 30, "electronics", 12),
        new Product(14, "Pizza", 15, "food", 6),
        new Product(15, "Eggs", 8, "food", 0),
        new Product(16, "Lasagna", 12, "food", 13),
        new Product(17, "Digital Camera", 550, "electronics", 1),
        new Product(18, "Laptop N3580", 340, "electronics", 5),
        new Product(19, "Headphones", 120, "electronics", 3),
        new Product(20, "Laptop J1020", 690, "electronics", 5));
}
$products = $_SESSION["products"];

if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = array(
        new User("Maria", "test", 2000, "user"),
        new User("Georgi", "test", 1000, "user"),
        new User("Mery", "test", 5000, "admin"),
        new User("Petyr", "test", 500, "user"),
        new User("Iva", "test", 10000, "user"));
}
$users = $_SESSION["users"];

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
$controllerInstance->loadModels($products, $users);

// bind Post model
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $reflection = new ReflectionMethod($controllerInstance, $route['method']);

    if (isset($reflection->getParameters()[0])) {
        $param = $reflection->getParameters()[0];
    }
    else {
        die($route['method'] . " should have a binding model.");
    }

    $bindingClass = $param->getClass();
    $bindingClassInstance = new $bindingClass->name();

    $reflection = new ReflectionClass($bindingClass->name);
    $bindingClassProperties = $reflection->getProperties();
    $postProperties = $_POST;

    foreach ($bindingClassProperties as $prop) {
        $propertyName = $prop->getName();

        if (count($bindingClassProperties) !== count($postProperties)) {
            die("Automatic binding of the post model failed for " . $bindingClass->name);
        }

        $isModelBindingOk = false;
        foreach ($postProperties as $name => $value) {
            if ($name === $propertyName) {
                $bindingClassInstance->$propertyName = $value;
                $isModelBindingOk = true;
                break;
            }
        }

        if (!$isModelBindingOk) {
            die("Automatic binding of the post model failed for " . $bindingClass->name);
        }
    }

    $actionResult = call_user_func_array(array($controllerInstance, $route['method']), array($bindingClassInstance));
}
else {
    $actionResult = call_user_func_array(array($controllerInstance, $route['method']), array(null));
}

// render view
if (isset($actionResult) && get_class($actionResult) === "View") {
    $view = get_class($actionResult);

    $viewPath = null;
    $viewFolder = str_ireplace("Controller", "", $route['controller']);
    if (isset($actionResult->viewName)) {
        $view = $actionResult->viewName.".php";
        $viewPath = PATH_TO_APP."views".DS.$viewFolder.DS.$actionResult->viewName.".php";
    }
    else {
        $viewPath = PATH_TO_APP."views".DS.$viewFolder.DS.$route['method'] . ".php";
    }

    $expectedViewModel = AnnotationHelper::getViewModelType($viewPath);

    if (isset($expectedViewModel)) {
        $expectedViewModel = explode("/", $expectedViewModel)[1];

        if (is_object($actionResult->model)) {
            if (get_class($actionResult->model) !== $expectedViewModel) {
                die ("The view '" . explode(".", $view)[0] . "' expects a " . $expectedViewModel . " view model.
                        The actual one is " . get_class($actionResult->model) . ".");
            }
        }

        die ("The view '" . explode(".", $view)[0] . "' expects a " . $expectedViewModel . " view model.");
    }

    $actionResult->render($viewPath);
}
?>