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
     * @param string $flagType Flag type
     * @param string $value Value to flag
     * @param string $reason Reason for flagging
     * @param string|null $comment Optional comment
     * @return array API response
     * @throws TombaException
     */
    public function createFlag(string $flagType, string $value, string $reason, ?string $comment = null): array
    {
        if (empty($flagType)) {
            throw new TombaException('Missing required parameter: "flagType"');
        }

        if (empty($value)) {
            throw new TombaException('Missing required parameter: "value"');
        }

        if (empty($reason)) {
            throw new TombaException('Missing required parameter: "reason"');
        }

        $path   = '/flag';
        $params = [];

        $params['flag_type'] = $flagType;
        $params['value'] = $value;
        $params['reason'] = $reason;

        if (!is_null($comment)) {
            $params['comment'] = $comment;
        }

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
