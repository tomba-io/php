<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Status extends Service
{
    /**
     * Domain Status
     *
     * Returns domain status indicating if it is a webmail or disposable domain.
     *
     * @see https://docs.tomba.io/api/domain#domain-status#domain-status
     *
     * @param string $domain Domain name to check
     * @return array API response
     * @throws TombaException
     */
    public function domainStatus(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/domain-status';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Company Autocomplete
     *
     * Auto-complete company names and retrieve logo and domain information.
     *
     * @see https://docs.tomba.io/api/domain#domain-status#company-autocomplete
     *
     * @param string $query Company name search query
     * @return array API response
     * @throws TombaException
     */
    public function autoComplete(string $query): array
    {
        if (empty($query)) {
            throw new TombaException('Missing required parameter: "query"');
        }

        $path   = '/domain-suggestions';
        $params = [];

        $params['query'] = $query;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
