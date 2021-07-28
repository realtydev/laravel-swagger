<?php

namespace realtydev\LaravelSwagger\Definitions\Security;

use InvalidArgumentException;
use realtydev\LaravelSwagger\Definitions\Security\Contracts\SecurityDefinitionsGenerator;

class SecurityDefinitionsFactory
{
    /**
     * @param string $securityType
     * @param string $authFlow
     * @return SecurityDefinitionsGenerator
     * @throws \realtydev\LaravelSwagger\LaravelSwaggerException
     */
    public static function createGenerator(
        string $securityType,
        string $authFlow
    ): SecurityDefinitionsGenerator {
        if ($securityType === 'oauth2') {
            return new OAuthSecurityDefinitionsGenerator($authFlow);
        }

        if ($securityType === 'jwt') {
            return new JWTSecurityDefinitionsGenerator();
        }

        throw new InvalidArgumentException('Unsupported security type');
    }
}
