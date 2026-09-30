<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class LeadsLists extends Service
{
    /**
     * Get Leads Lists
     *
     * Returns a list of leads lists.
     *
     * @see https://docs.tomba.io/api/leads-lists#list-leads-lists
     *
     * @return array API response
     * @throws TombaException
     */
    public function getLists(): array
    {
        $path   = '/leads_lists';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Delete List
     *
     * Delete a specific leads list by ID.
     *
     * @see https://docs.tomba.io/api/leads-lists#delete-leads-list
     *
     * @param string $id List ID
     * @return array API response
     * @throws TombaException
     */
    public function deleteListId(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/leads_lists/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create List
     *
     * Create a new leads list with the name request parameter.
     *
     * @see https://docs.tomba.io/api/leads-lists#create-leads-list
     *
     * @param string $name List name
     * @return array API response
     * @throws TombaException
     */
    public function createList(string $name): array
    {
        if (empty($name)) {
            throw new TombaException('Missing required parameter: "name"');
        }

        $path   = '/leads_lists';
        $params = [];

        $params['name'] = $name;

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Update List
     *
     * Update the fields of a leads list by ID.
     *
     * @see https://docs.tomba.io/api/leads-lists#update-leads-list
     *
     * @param string $id List ID
     * @param string $name New list name
     * @return array API response
     * @throws TombaException
     */
    public function updateListId(string $id, string $name): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        if (empty($name)) {
            throw new TombaException('Missing required parameter: "name"');
        }

        $path = '/leads_lists/' . $id;
        $params = [];

        $params['name'] = $name;

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
