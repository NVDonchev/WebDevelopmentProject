<?php 

class HomeController
{
    function __construct() {
        include "bindingModels".DS."helloBindingModel.php";
    }

	public function index()
	{
        return new View(null, "personForm");
	}

	public function hello(HelloBindingModel $model)
	{
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            return new View($model, "formResults");
        }
    }


    public function postPersonInfo(HelloBindingModel $model)
    {
        return new View($model, "formResults");
    }
}

?>