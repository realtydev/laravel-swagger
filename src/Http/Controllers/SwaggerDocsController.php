<?php

namespace realtydev\LaravelSwagger\Http\Controllers;

use Illuminate\Routing\Controller;
use realtydev\LaravelSwagger\SwaggerDocsManager;

class SwaggerDocsController extends Controller
{
    /**
     * @var SwaggerDocsManager
     */
    private $swaggerDocsManager;

    public function __construct(SwaggerDocsManager $swaggerDocsManager)
    {
        $this->swaggerDocsManager = $swaggerDocsManager;
    }

    /**
     * Return the page with swagger docs.
     *
     * @param string|null $version
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(string $version = null)
    {
        $version = $version ?? $this->swaggerDocsManager->getLatestVersion();

        $apiVersions = $this->swaggerDocsManager->getVersionRoutePaths();

        $filePath = $this->swaggerDocsManager->getSwaggerFileUrl($version);

        return view('laravel-swagger::index')
            ->with([
                'filePath' => $filePath,
                'apiVersions' => $apiVersions,
                'currentVersion' => $version,
            ]);
    }
}
