<?php

namespace realtydev\LaravelSwagger\Definitions\Security;

use realtydev\LaravelSwagger\DataObjects\Route;
use realtydev\LaravelSwagger\Definitions\Security\Contracts\SecurityDefinitionsGenerator;

class JWTSecurityDefinitionsGenerator implements SecurityDefinitionsGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate(String $name = 'Authorization', String $auth = 'Bearer'): array
    {
        return [
            $auth => [
                'type' => 'apiKey',
                'name' => $name,
                'in' => 'header',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function generateForRoute(Route $route): array
    {
        if (!$route->hasAuthMiddleware()) {
            return [];
        }

        return [
            [
                'Bearer' => [],
            ],
        ];
    }
}
