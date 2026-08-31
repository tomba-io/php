<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Count;
use Tomba\TombaException;

class CountTest extends TestCase
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
        $this->assertTrue(class_exists(Count::class));
    }

    public function testEmailCount(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $count = new Count(self::makeClient());
        $result = $count->emailCount('tomba.io');
        $this->assertIsArray($result);
    }

    public function testEmailCountMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $count = new Count(self::makeClient());
        $count->emailCount('');
    }
}
