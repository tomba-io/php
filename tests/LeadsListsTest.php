<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\LeadsLists;
use Tomba\TombaException;

class LeadsListsTest extends TestCase
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
        $this->assertTrue(class_exists(LeadsLists::class));
    }

    public function testGetLists(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $lists = new LeadsLists(self::makeClient());
        $result = $lists->getLists();
        $this->assertIsArray($result);
    }

    public function testDeleteListIdMissingId(): void
    {
        $this->expectException(TombaException::class);
        $lists = new LeadsLists(self::makeClient());
        $lists->deleteListId('');
    }

    public function testUpdateListIdMissingId(): void
    {
        $this->expectException(TombaException::class);
        $lists = new LeadsLists(self::makeClient());
        $lists->updateListId('');
    }
}
