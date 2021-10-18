<?php

namespace Tomba\Services;

use Tomba\TombaException;
use Tomba\Client;
use Tomba\Service;

class Finder extends Service
{
    /**
     * Email Finder
     *
     * generates or retrieves the most likely email address from a domain name, a
     * first name and a last name.
     *
     * @param string $domain
     * @param string $firstName
     * @param string $lastName
     * @throws TombaException
     * @return array
     */
    public function emailFinder(string $domain, string $firstName, string $lastName): array
    {
        if (!isset($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        if (!isset($firstName)) {
            throw new TombaException('Missing required parameter: "firstName"');
        }

        if (!isset($lastName)) {
            throw new TombaException('Missing required parameter: "lastName"');
        }

        $path   = str_replace(['{domain}'], [$domain], '/email-finder/{domain}');
        $params = [];

        if (!is_null($firstName)) {
            $params['first_name'] = $firstName;
        }

        if (!is_null($lastName)) {
            $params['last_name'] = $lastName;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
