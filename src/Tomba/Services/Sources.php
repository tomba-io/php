<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Sources extends Service
{
    /**
     * Email Sources
     *
     * Find email address source somewhere on the web.
     *
     * @see https://docs.tomba.io/api/sources#email-sources
     *
     * @param string $email Email address to find sources for
     * @return array API response
     * @throws TombaException
     */
    public function emailSources(string $email): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/email-sources';
        $params = [];

        $params['email'] = $email;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
