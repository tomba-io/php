<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Bulk;
use Tomba\TombaException;

class BulkTest extends TestCase
{
    private static function hasCredentials(): bool
    {
        return !empty(getenv('TOMBA_API_KEY')) && !empty(getenv('TOMBA_SECRET_KEY'));
    }

    private static function makeClient(): Client
    {
        $client = new Client();
        $client->setKey(getenv('TOMBA_API_KEY'));
        $client->setSecret(getenv('TOMBA_SECRET_KEY'));
        return $client;
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(Bulk::class));
    }

    public function testListBulks(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $bulk = new Bulk(self::makeClient());
        $result = $bulk->listBulks('finder');
        $this->assertIsArray($result);
    }

    public function testListBulksMissingType(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->listBulks('');
    }

    public function testGetBulkMissingType(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->getBulk('', 1);
    }

    public function testCreateBulkMissingType(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->createBulk('', ['name' => 'test']);
    }

    public function testCreateBulkMissingData(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->createBulk('finder', []);
    }

    public function testDeleteBulkMissingType(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->deleteBulk('', 1);
    }

    public function testRenameBulkMissingName(): void
    {
        $this->expectException(TombaException::class);
        $bulk = new Bulk(self::makeClient());
        $bulk->renameBulk('finder', 1, '');
    }
}
