<?php

namespace realtydev\LaravelSwagger\Traits;

trait HasAppends
{
    public function getAppends(): array
    {
        if (!property_exists($this, 'appends')) {
            return [];
        }

        return $this->appends;
    }
}
