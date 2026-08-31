<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Similar extends Service
{
    /**
     * Similar Websites
     *
     * Returns a list of websites similar to the given domain.
     *
     * @see https://docs.tomba.io/api/similar#similar-websites
     *
     * @param string $domain Domain name to find similar websites for
     * @return array API response
     * @throws TombaException
     */
    public function websites(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/similar';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
