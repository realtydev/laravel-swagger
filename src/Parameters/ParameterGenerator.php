<?php

namespace realtydev\LaravelSwagger\Parameters;

interface ParameterGenerator
{
    public function getParameters(): array;

    public function getParamLocation(): string;
}
