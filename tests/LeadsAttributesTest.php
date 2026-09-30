<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\LeadsAttributes;
use Tomba\TombaException;

class LeadsAttributesTest extends TestCase
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
        $this->assertTrue(class_exists(LeadsAttributes::class));
    }

    public function testGetLeadAttributes(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $attrs = new LeadsAttributes(self::makeClient());
        $result = $attrs->getLeadAttributes();
        $this->assertIsArray($result);
    }

    public function testDeleteLeadAttributeMissingId(): void
    {
        $this->expectException(TombaException::class);
        $attrs = new LeadsAttributes(self::makeClient());
        $attrs->deleteLeadAttribute('');
    }

    public function testUpdateLeadAttributeMissingId(): void
    {
        $this->expectException(TombaException::class);
        $attrs = new LeadsAttributes(self::makeClient());
        $attrs->updateLeadAttribute('', 'test');
    }
}
