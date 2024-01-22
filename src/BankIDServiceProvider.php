<?php

namespace Jgroup\BankID;

use JsonMapper;
use Illuminate\Support\Str;
use Jgroup\BankID\RpApi\RpApi;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;
use Jgroup\BankID\Service\BankIDService;
use Illuminate\Contracts\Foundation\Application;

class BankIDServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('bankid.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../bankid_certificates' => base_path('bankid_certificates'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bankid');

        $this->setupBindings();

        $this->mergeLoggingChannels();
    }

    protected function mergeLoggingChannels(): void
    {
        $packageLoggingConfig = config('bankid.logging');

        $config = $this->app->make('config');

        $config->set('logging.channels', array_merge(
            $packageLoggingConfig['channels'] ?? [],
            $config->get('logging.channels', [])
        ));
    }

    protected function setupBindings(): void
    {
        $this->app->bind(RpApi::class, function (Application $app, array $httpClientOptions = []) {
            $env         = config('bankid.use_environment');
            $baseUrl     = config("bankid.environments.$env.url");
            $caCertPath  = config("bankid.environments.$env.ca_cert_path");
            $certPath    = config("bankid.environments.$env.cert_path");
            $certKeyPath = config("bankid.environments.$env.cert_key_path");

            $httpClient = new HttpClient(array_merge([
                'base_uri'    => Str::finish($baseUrl, '/'),
                'verify'      => $caCertPath,
                'cert'        => $certPath,
                'ssl_key'     => $certKeyPath,
                'http_errors' => true,
                'headers'     => [
                    'Content-Type' => 'application/json',
                ],
            ], $httpClientOptions));

            $mapper                    = new JsonMapper();
            $mapper->bIgnoreVisibility = true;

            return new RpApi(
                $httpClient,
                $baseUrl,
                $certPath,
                $certKeyPath,
                $caCertPath,
                $mapper
            );
        });

        $this->app->bind('bankid', function (Application $app) {
            return new BankIDService(
                $app->make(RpApi::class),
                $app->make('session.store'),
                $app->make('log'),
                config('bankid.transaction_session_key')
            );
        });
    }
}
