<?php 

/**
* Represents data about a route
*/
class Router
{

	static public function normalizeUri($uri) 
	{
		$uriNoDirname = str_replace(APP_DIR_NAME, "", $uri);
		$split = explode("/", $uriNoDirname);
		$noEmptySplit = array_filter($split);

		$result = implode("/", $noEmptySplit);

		return $result;
	}

	static public function uriHasArea($uriToCheck)
	{
		$uri = Router::normalizeUri($uriToCheck);
		$split = explode("/", $uri);

		if (count($split) == 0) return false;

		$potentialArea = $split[0];
		$result = file_exists("areas".DS.$potentialArea);

		return $result;
	}

	static public function parseUri($uriToParse)	
	{
		$result = array();
		$routes = Router::getRoutes();

		$hasArea = Router::uriHasArea($uriToParse);
		
		$normalizedUri = Router::normalizeUri($uriToParse);
		$normalizedSplitUri = explode("/", $normalizedUri);

		// try custom routes
		foreach ($routes as $route) {
			if (strpos($route->url, $normalizeUri) == 0) {
				
				$result['area'] = $route['area'];
				$result['controller'] = $route['controller']."Controller";
				$result['method'] = $route['method'];
				
				$paramsUri = str_replace($route['url'], "", $normalizedUri);
				$params = explode("/", $paramsUri);

				$result['parameters'] = $params;

				return $result;
			}
		}

		// default route
		$result['controller'] = $normalizedSplitUri[0]."Controller";
		$result['method'] = $normalizedSplitUri[1] or 'index';
		if ($normalizedSplitUri[1]) {
			$result['parameters'] = array_slice($normalizedSplitUri, 2);
		}
	}

	static public function getRoutes()
	{
		$result = array();

		$areas = scandir("..".DS."areas");
		foreach ($areas as $area) {
			if ($area == "." || $area == "..") continue;
			$currentAreaRoutes = include "..".DS."areas".DS.$area."config".DS."routes.php";
			$result = array_merge($result, $currentAreaRoutes);
		}

		$appRoutes = include "..".DS."config"."routes.php";
		$result = array_merge($appRoutes);

		return $result;
	}

}

?>