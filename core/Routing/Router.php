<?php

class Router
{
    private RouteCollection $routeCollection;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    } 

    public function match()
    {
        $requestUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        foreach ($this->routeCollection->getAllRoute() as $route)
        {
            if ($route->getPath() === $requestUri) 
            {
                $controllerName = $route->getController();
                $methodName = $route->getMethod();
            
                $controller = new $controllerName();
            
                $controller->$methodName();
                exit;
            }
        }
    }
}

?>