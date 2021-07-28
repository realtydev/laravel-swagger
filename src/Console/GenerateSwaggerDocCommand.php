<?php

namespace realtydev\LaravelSwagger\Console;

use Illuminate\Console\Command;
use realtydev\LaravelSwagger\FormatterManager;
use realtydev\LaravelSwagger\Generator;
use realtydev\LaravelSwagger\SwaggerDocsManager;

class GenerateSwaggerDocCommand extends Command
{
    const DEFAULT_API_VERSION = '*';

    /**
     * @var SwaggerDocsManager
     */
    private $swaggerDocsManager;

    public function __construct(SwaggerDocsManager $swaggerDocsManager)
    {
        parent::__construct();

        $this->swaggerDocsManager = $swaggerDocsManager;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     * @todo When define the default value from "api-version" param as "*" the
     *       value returned by the method $this->option('api-version') returns
     *       an empty array.
     */
    protected $signature = 'laravel-swagger:generate
                            {--format=json : The format of the output, current options are json and yaml}
                            {--api-version= : The version of the swagger docs. Generate for all version by default}
                            {--f|filter= : Filter to a specific route prefix, such as /api or /v2/api}
                            {--o|output= : Output file to write the contents to, defaults to stdout}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generates a swagger documentation file for this application';

    /**
     * Execute the console command.
     *
     * @throws \realtydev\LaravelSwagger\LaravelSwaggerException
     * @throws \ReflectionException
     */
    public function handle(): void
    {
        $versions = $this->getVersionsConfigToGenerate();

        foreach ($versions as $versionConfig) {
            $filter = $this->option('filter') ?: null;

            $docs = (new Generator($versionConfig,$filter))->generate();

            $format = $this->option('format');


            $formattedDocs = (new FormatterManager($docs))
                ->setFormat($format)
                ->format();

            $fileName = $this->swaggerDocsManager->generateSwaggerFileName(
                $versionConfig['appVersion'],
                $format
            );

            file_put_contents(public_path($fileName), $formattedDocs);
        }
    }

    /**
     * Get versions config to generate swagger docs.
     */
    private function getVersionsConfigToGenerate(): array
    {
        $apiVersion = $this->option('api-version') ?? self::DEFAULT_API_VERSION;

        return $apiVersion === self::DEFAULT_API_VERSION
            ? $this->swaggerDocsManager->getAllVersionConfigs()
            : [$this->swaggerDocsManager->findVersionConfig($apiVersion)];
    }
}
