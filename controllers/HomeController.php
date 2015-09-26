<?php 

class HomeController
{
    function __construct() {
        include "BindingModels".DS."HelloBindingModel.php";
        include "models".DS."HelloModel.php";
    }

	public function index(HelloBindingModel $model)
	{
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            return new View($model, "formResults");
        }
        else {
            $model = new HelloModel();

            return new View($model, "personForm");
        }
	}

	public function hello(HelloBindingModel $model)
	{
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            return new View($model, "formResults");
        }
        else {
            $model = new HelloModel();

            return new View($model, "personForm");
        }
    }


    public function postPersonInfo(HelloBindingModel $model)
    {
        return new View($model, "formResults");
    }
}

?>