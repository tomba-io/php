<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Account extends Service
{
    /**
     * Get Account
     *
     * Returns information about the current account.
     *
     * @see https://docs.tomba.io/api/account#get-account
     *
     * @return array API response
     * @throws TombaException
     */
    public function getAccount(): array
    {
        $path   = '/me';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
