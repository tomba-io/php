<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class LeadsAttributes extends Service
{
    /**
     * Get Lead Attributes
     *
     * Returns a list of lead attributes.
     *
     * @see https://docs.tomba.io/api/leads-attributes#list-attributes
     *
     * @return array API response
     * @throws TombaException
     */
    public function getLeadAttributes(): array
    {
        $path   = '/attributes';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Delete Lead Attribute
     *
     * Delete a specific attribute by ID.
     *
     * @see https://docs.tomba.io/api/lead-attributes#delete-a-lead-attribute
     *
     * @param string $id Attribute ID
     * @return array API response
     * @throws TombaException
     */
    public function deleteLeadAttribute(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/attributes/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create Lead Attribute
     *
     * Create a new attribute with the name and type request parameter.
     *
     * @see https://docs.tomba.io/api/lead-attributes#create-a-lead-attribute
     *
     * @param string $name Attribute name
     * @param string $type Attribute type
     * @return array API response
     * @throws TombaException
     */
    public function createLeadAttribute(string $name, string $type): array
    {
        if (empty($name)) {
            throw new TombaException('Missing required parameter: "name"');
        }

        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $path   = '/attributes';
        $params = [];

        $params['name'] = $name;
        $params['type'] = $type;

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Update Lead Attribute
     *
     * Update the fields of an attribute by ID.
     *
     * @see https://docs.tomba.io/api/lead-attributes#update-a-lead-attribute
     *
     * @param string $id Attribute ID
     * @param string $name New attribute name
     * @return array API response
     * @throws TombaException
     */
    public function updateLeadAttribute(string $id, string $name): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        if (empty($name)) {
            throw new TombaException('Missing required parameter: "name"');
        }

        $path = '/attributes/' . $id;
        $params = [];

        $params['name'] = $name;

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
