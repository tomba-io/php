<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Domain extends Service
{
    /**
     * Domain Search
     *
     * Search emails by domain name. Returns all email addresses found for a given domain.
     *
     * @see https://docs.tomba.io/api/finder#domain-search#domain-search
     *
     * @param string $domain Domain name to search
     * @param int|null $page Page number for pagination
     * @param int|null $limit Number of results per page
     * @param string|null $department Filter by department
     * @param bool|null $enrichMobile Whether to enrich mobile phone data
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array|string API response
     * @throws TombaException
     */
    public function domainSearch(string $domain, int $page = null, int $limit = null, string $department = null, bool $enrichMobile = null, string $webhookUrl = null): array|string
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/domain-search';
        $params = [];

        $params['domain'] = $domain;

        if (!is_null($page)) {
            $params['page'] = $page;
        }

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        if (!is_null($department)) {
            $params['department'] = $department;
        }

        if (!is_null($enrichMobile)) {
            $params['enrich_mobile'] = $enrichMobile;
        }

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
