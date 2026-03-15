<?php

spl_autoload_register(function (string $class): void 
{
    if (!str_starts_with($class, 'App\\')) 
    {
        return;
    }

    $relativeClass = substr($class, strlen('App\\'));

    $file = __DIR__ . '/../App/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) 
    {
        require_once $file;
    } 
    else 
    {
        header('Content-Type: text/html; charset=utf-8');
        http_response_code(500);
        die("Autoload erreur : classe introuvable<br><b>$class</b><br>Fichier attendu :<br><code>" . htmlspecialchars($file) . "</code>");
    }
}, prepend: true);

require "../core/Routing/Route.php";
require "../core/Routing/Router.php";
require "../core/Routing/RouteCollection.php";

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

<button onclick="window.location.href='<?php echo htmlspecialchars($routeCollection->getRouteByName('createUser')->getPath()) ?>'">createUser</button>