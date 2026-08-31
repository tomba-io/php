<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Format extends Service
{
    /**
     * Email Format
     *
     * Returns the email format used by a given domain.
     *
     * @see https://docs.tomba.io/api/format#email-format
     *
     * @param string $domain Domain name to retrieve format for
     * @return array API response
     * @throws TombaException
     */
    public function emailFormat(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/email-format';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
