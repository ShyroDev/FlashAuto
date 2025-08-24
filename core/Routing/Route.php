<?php

class Route
{
    public string $nom;
    public string $path;
    public string $controller;
    public string $method;
    public array $param = [];

    public function __construct(string $nom, string $path, string $controller, string $method)
    {
        $this->nom = $nom;
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;   
    }

    public function getNom() 
    {
        return $this->nom;
    }

    public function getPath() : string
    {
        return $this->path;
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getController() : string
    {
        return $this->controller;
    }
}
