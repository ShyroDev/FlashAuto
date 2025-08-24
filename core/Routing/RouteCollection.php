<?php

class RouteCollection
{
    private array $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function getRouteByName(string $name) : ?Route
    {
        foreach($this->routes as $route)
        {
            if($route->getNom() === $name)
            {
                return $route;
            }
        }
        return null;
    }

    public function getAllRoute()
    {
        return $this->routes;
    }
}

?>