<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Location extends Service
{
    /**
     * Get Location
     *
     * Returns the geographic location information for a given domain.
     *
     * @see https://docs.tomba.io/api/finder#location#get-location
     *
     * @param string $domain Domain name to retrieve location for
     * @return array API response
     * @throws TombaException
     */
    public function getLocation(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/location';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
