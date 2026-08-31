<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Enrichment extends Service
{
    /**
     * Person Enrichment
     *
     * Enrich a person by email address. Returns detailed information about the person.
     *
     * @see https://docs.tomba.io/api/enrichment#person-enrichment
     *
     * @param string $email Email address of the person to enrich
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function person(string $email, string $webhookUrl = null): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/people/find';
        $params = [];

        $params['email'] = $email;

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Company Enrichment
     *
     * Enrich a company by domain name. Returns detailed information about the company.
     *
     * @see https://docs.tomba.io/api/enrichment#company-enrichment
     *
     * @param string $domain Domain name of the company to enrich
     * @return array API response
     * @throws TombaException
     */
    public function company(string $domain): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        $path   = '/companies/find';
        $params = [];

        $params['domain'] = $domain;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Combined Enrichment
     *
     * Enrich both person and company data by email address.
     *
     * @see https://docs.tomba.io/api/enrichment#combined-enrichment
     *
     * @param string $email Email address for combined enrichment
     * @return array API response
     * @throws TombaException
     */
    public function combined(string $email): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/combined/find';
        $params = [];

        $params['email'] = $email;

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
