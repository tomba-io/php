<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Leads extends Service
{
    /**
     * List Leads
     *
     * Returns a paginated list of leads.
     *
     * @see https://docs.tomba.io/api/leads
     *
     * @param int|null $page Page number for pagination
     * @param int|null $limit Number of results per page
     * @param string|null $domain Filter leads by domain
     * @return array API response
     * @throws TombaException
     */
    public function listLeads(?int $page = null, ?int $limit = null, ?string $domain = null): array
    {
        $path   = '/leads';
        $params = [];

        if (!is_null($page)) {
            $params['page'] = $page;
        }

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        if (!is_null($domain)) {
            $params['domain'] = $domain;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Get Lead
     *
     * Returns a specific lead by ID.
     *
     * @see https://docs.tomba.io/api/leads#retrieve-a-single-lead
     *
     * @param string $id Lead ID
     * @return array API response
     * @throws TombaException
     */
    public function getLead(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/leads/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create Lead
     *
     * Create a new lead with the provided data.
     *
     * @see https://docs.tomba.io/api/leads#create-a-lead
     *
     * @param array $data Lead data (email, first_name, last_name, etc.)
     * @return array API response
     * @throws TombaException
     */
    public function createLead(array $data): array
    {
        if (empty($data)) {
            throw new TombaException('Missing required parameter: "data"');
        }

        $path   = '/leads';

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $data);
    }

    /**
     * Update Lead
     *
     * Update an existing lead by ID.
     *
     * @see https://docs.tomba.io/api/leads#update-a-lead
     *
     * @param string $id Lead ID
     * @param array $data Updated lead data
     * @return array API response
     * @throws TombaException
     */
    public function updateLead(string $id, array $data): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/leads/' . $id;

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $data);
    }

    /**
     * Delete Lead
     *
     * Delete a specific lead by ID.
     *
     * @see https://docs.tomba.io/api/leads#delete-a-lead
     *
     * @param string $id Lead ID
     * @return array API response
     * @throws TombaException
     */
    public function deleteLead(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/leads/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
