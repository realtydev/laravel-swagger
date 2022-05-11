<?php

namespace realtydev\LaravelSwagger\Definitions\Security;

use realtydev\LaravelSwagger\DataObjects\Route;
use realtydev\LaravelSwagger\Definitions\Security\Contracts\SecurityDefinitionsGenerator;

class JWTSecurityDefinitionsGenerator implements SecurityDefinitionsGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate(): array
    {
        return [
            'Bearer' => [
                'type' => 'apiKey',
                'name' => 'Authorization',
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
