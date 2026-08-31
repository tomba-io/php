<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Logs extends Service
{
    /**
     * Get Logs
     *
     * Returns your last 1,000 API requests made during the last 3 months.
     *
     * @see https://docs.tomba.io/api/account#retrieve-api-logs#get-logs
     *
     * @param int|null $page Page number for pagination
     * @param int|null $limit Number of results per page
     * @return array API response
     * @throws TombaException
     */
    public function getLogs(?int $page = null, ?int $limit = null): array
    {
        $path   = '/logs';
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
}
