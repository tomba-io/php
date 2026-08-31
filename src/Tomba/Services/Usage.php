<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Usage extends Service
{
    /**
     * Get Usage
     *
     * Returns your monthly API request usage.
     *
     * @see https://docs.tomba.io/api/account#retrieve-api-usage#get-usage
     *
     * @return array API response
     * @throws TombaException
     */
    public function getUsage(): array
    {
        $path   = '/usage';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
