<?php 

class HomeController
{
	public function index()
	{
        $model =  "Hello from HomeController::index() !";

        return new View($model);
	}

	public function hello()
	{
        $model = "Hello from HomeController::hello() !";

        return new View($model);
    }
}

?>