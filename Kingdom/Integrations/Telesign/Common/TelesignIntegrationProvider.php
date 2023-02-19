<?php

namespace Kingdom\Integrations\Telesign\Common;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class TelesignIntegrationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TelesignService::class, function () {
            $baseUri = 'https://rest-api.telesign.com/';
            $client = new Client([
                'base_uri' => $baseUri,
                'auth' => [
                    config('kingdom.integrations.telesign.customer_id'),
                    config('kingdom.integrations.telesign.secret')
                ]
            ]);
            return new TelesignBaseClient($client);
        });
    }
}
