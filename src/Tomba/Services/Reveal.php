<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Reveal extends Service
{
    /**
     * Companies Search
     *
     * Search for companies using various filters and criteria.
     *
     * @see https://docs.tomba.io/api/reveal#companies-search
     *
     * @param array $params Search parameters (filters, pagination, etc.)
     * @return array API response
     * @throws TombaException
     */
    public function companiesSearch(array $params): array
    {
        if (empty($params)) {
            throw new TombaException('Missing required parameter: "params"');
        }

        $path   = '/reveal/search';

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
