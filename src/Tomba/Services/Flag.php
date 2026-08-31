<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Flag extends Service
{
    /**
     * List Flags
     *
     * Returns a list of all flagged email addresses.
     *
     * @see https://docs.tomba.io/api/flag#list-flags
     *
     * @param int|null $page Page number for pagination
     * @param int|null $limit Number of results per page
     * @return array API response
     * @throws TombaException
     */
    public function listFlags(?int $page = null, ?int $limit = null): array
    {
        $path   = '/flag';
        $params = [];

        if (!is_null($page)) {
            $params['page'] = $page;
        }

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create Flag
     *
     * Flag an email address as invalid or incorrect.
     *
     * @see https://docs.tomba.io/api/flag#create-flag
     *
     * @param string $email Email address to flag
     * @param string|null $reason Optional reason for flagging
     * @return array API response
     * @throws TombaException
     */
    public function createFlag(string $email, ?string $reason = null): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/flag';
        $params = [];

        $params['email'] = $email;

        if (!is_null($reason)) {
            $params['reason'] = $reason;
        }

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
