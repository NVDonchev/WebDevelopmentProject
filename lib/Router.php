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
			if (strpos($route["url"], $normalizedUri) === 0) {

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
        if ($hasArea) {
            $result['area'] = $normalizedSplitUri[0];
            $result['controller'] = $normalizedSplitUri[1]."Controller";
            if (isset($normalizedSplitUri[2])) {
                $result['method'] = $normalizedSplitUri[2];
                $result['parameters'] = array_slice($normalizedSplitUri, 3);
            }
            else {
                $result['method'] = 'index';
            }
        }
        else {
            $result['controller'] = $normalizedSplitUri[0]."Controller";
            if (isset($normalizedSplitUri[1])) {
                $result['method'] = $normalizedSplitUri[1];
                $result['parameters'] = array_slice($normalizedSplitUri, 2);
            }
            else {
                $result['method'] = 'index';
            }
        }

        return $result;
	}

	static public function getRoutes()
	{
        $result = array();
		$areas = scandir(PATH_TO_APP."areas");
		foreach ($areas as $area) {
			if ($area == "." || $area == "..") continue;
			$currentAreaRoutes = include PATH_TO_APP."areas".DS.$area.DS."config".DS."routes.php";
			$result = array_merge($result, $currentAreaRoutes);
		}

		$appRoutes = include PATH_TO_APP."config".DS."routes.php";
		$result = array_merge($appRoutes);

		return $result;
	}

}

?>