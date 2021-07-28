<?php

namespace realtydev\LaravelSwagger\Definitions\Security\Contracts;

use realtydev\LaravelSwagger\DataObjects\Route;
use realtydev\LaravelSwagger\LaravelSwaggerException;

interface SecurityDefinitionsGenerator
{
    /**
     * @throws LaravelSwaggerException
     */
    public function generate(): array;

    public function generateForRoute(Route $route): array;
}
