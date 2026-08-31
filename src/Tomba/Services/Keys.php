<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Keys extends Service
{
    /**
     * Get Keys
     *
     * Returns a list of your API keys.
     *
     * @see https://docs.tomba.io/api/keys
     *
     * @return array API response
     * @throws TombaException
     */
    public function getKeys(): array
    {
        $path   = '/keys';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Get Key
     *
     * Returns a specific API key by ID.
     *
     * @see https://docs.tomba.io/api/keys#get-key
     *
     * @param string $id Key ID
     * @return array API response
     * @throws TombaException
     */
    public function getKey(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/keys/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Delete Key
     *
     * Delete a specific API key by ID.
     *
     * @see https://docs.tomba.io/api/keys#delete-an-api-key
     *
     * @param string $id Key ID
     * @return array API response
     * @throws TombaException
     */
    public function deleteKey(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/keys/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create Key
     *
     * Create a new API key.
     *
     * @see https://docs.tomba.io/api/keys#create-an-api-key
     *
     * @return array API response
     * @throws TombaException
     */
    public function createKey(): array
    {
        $path   = '/keys';
        $params = [];

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Reset Key
     *
     * Reset a specific API key by ID.
     *
     * @see https://docs.tomba.io/api/keys#reset-an-api-key
     *
     * @param string $id Key ID
     * @return array API response
     * @throws TombaException
     */
    public function resetKey(string $id): array
    {
        if (empty($id)) {
            throw new TombaException('Missing required parameter: "id"');
        }

        $path = '/keys/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
