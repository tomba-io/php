<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Technology extends Service
{
    /**
     * List Technologies
     *
     * Returns the technologies used by a given domain.
     *
     * @see https://docs.tomba.io/api/domain#technology#list-technologies
     *
     * @param string $domain Domain name to retrieve technologies for
     * @return array API response
     * @throws TombaException
     */
    public function list(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/technology';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
