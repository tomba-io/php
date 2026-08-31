<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Bulk extends Service
{
    /**
     * Valid bulk operation types.
     */
    private const VALID_TYPES = ['search', 'similar', 'company', 'finder', 'enrich', 'linkedin', 'author', 'verifier', 'phone-finder', 'phone-validator'];

    /**
     * Validate the bulk type parameter.
     *
     * @param string $type The bulk type to validate.
     * @throws TombaException If the type is not valid.
     */
    private function validateType(string $type): void
    {
        if (!in_array($type, self::VALID_TYPES, true)) {
            throw new TombaException(
                'Invalid bulk type: "' . $type . '". Must be one of: ' . implode(', ', self::VALID_TYPES)
            );
        }
    }

    /**
     * List Bulk Tasks
     *
     * Returns a list of bulk tasks for the given type.
     *
     * @see https://docs.tomba.io/api/bulks-tasks
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param array|null $params Optional query parameters (page, limit, etc.)
     * @return array API response
     * @throws TombaException
     */
    public function listBulks(string $type, ?array $params = null): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type;
        $queryParams = $params ?? [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $queryParams);
    }

    /**
     * Get Bulk Task
     *
     * Returns a specific bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk#get-bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function getBulk(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Create Bulk Task
     *
     * Create a new bulk task for the given type.
     *
     * @see https://docs.tomba.io/api/bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param array $data Bulk task data
     * @return array API response
     * @throws TombaException
     */
    public function createBulk(string $type, array $data): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        if (empty($data)) {
            throw new TombaException('Missing required parameter: "data"');
        }

        $path = '/bulk/' . $type;

        return $this->client->call(Client::METHOD_POST, $path, [
            'content-type' => 'application/json',
        ], $data);
    }

    /**
     * Launch Bulk Task
     *
     * Launch (start processing) a bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function launchBulk(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id;
        $params = [];

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Delete Bulk Task
     *
     * Delete a bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function deleteBulk(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id . '/delete';
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Archive Bulk Task
     *
     * Archive a bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function archiveBulk(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id . '/archive';
        $params = [];

        return $this->client->call(Client::METHOD_DELETE, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Rename Bulk Task
     *
     * Rename a bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk-task
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @param string $name New name for the bulk task
     * @return array API response
     * @throws TombaException
     */
    public function renameBulk(string $type, int $id, string $name): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        if (empty($name)) {
            throw new TombaException('Missing required parameter: "name"');
        }

        $path = '/bulk/' . $type . '/' . $id . '/rename';
        $params = ['name' => $name];

        return $this->client->call(Client::METHOD_PUT, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Bulk Progress
     *
     * Returns the progress of a bulk task by type and ID.
     *
     * @see https://docs.tomba.io/api/bulk
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function bulkProgress(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id . '/progress';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Download Bulk Results
     *
     * Download the results of a completed bulk task.
     *
     * @see https://docs.tomba.io/api/bulk
     *
     * @param string $type Bulk type (e.g., "finder", "verifier")
     * @param int $id Bulk task ID
     * @return array API response
     * @throws TombaException
     */
    public function downloadBulk(string $type, int $id): array
    {
        if (empty($type)) {
            throw new TombaException('Missing required parameter: "type"');
        }

        $this->validateType($type);

        $path = '/bulk/' . $type . '/' . $id . '/download';
        $params = [];

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
