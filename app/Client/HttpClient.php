<?php

declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\Client;

class HttpClient
{
    public static function handler(): Client
    {

        $client = new Client([
            'base_uri' => 'https://backend-challenge.hasura.app/v1/graphql',
            'timeout'  => 30,
            'headers' => [
                "Content-type" => "application/json",
                "x-hasura-admin-secret" => "uALQXDLUu4D9BC8jAfXgDBWm1PMpbp0pl5SQs4chhz2GG14gAVx5bfMs4I553keV"
            ],
            'verify' => false,
        ]);

        return $client;
    }
}
