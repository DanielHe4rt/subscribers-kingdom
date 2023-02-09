<?php

namespace Kingdom\Integrations\Twilio\Common;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class TwilioIntegrationProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(TwilioService::class, function () {
            $baseUri = sprintf(
                'https://api.twilio.com/2010-04-01/Accounts/%s/',
                config('kingdom.integrations.twilio.sid')
            );
            $client =  new Client([
                'base_uri' => $baseUri,
                'auth' => [
                    config('kingdom.integrations.twilio.sid'),
                    config('kingdom.integrations.twilio.secret')
                ]
            ]);
            return new TwilioBaseClient($client);
        });
    }
}
