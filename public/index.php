<?php

require "../core/Routing/Route.php";
require "../core/Routing/Router.php";
require "../core/Routing/RouteCollection.php";

require_once __DIR__ . '/../app/Controllers/TestController.php';

$json = file_get_contents("../config/routes.json");
$routing = json_decode($json, true);
$tempRoute = [];

foreach($routing as $routes)
{
    foreach($routes as $route)
    {
        $r = new Route($route['nom'], $route['path'], $route['controller'], $route['method']);
        $tempRoute[] = $r;
    }
}

$routeCollection = new RouteCollection($tempRoute);
$router = new Router($routeCollection);
$router->match();


?>


<button onclick="window.location.href='<?php echo htmlspecialchars($routeCollection->getRouteByName('test')->getPath()) ?>'">TEST</button>