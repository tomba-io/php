<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Location;
use Tomba\TombaException;

class LocationTest extends TestCase
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
        $this->assertTrue(class_exists(Location::class));
    }

    public function testGetLocation(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $location = new Location(self::makeClient());
        $result = $location->getLocation('tomba.io');
        $this->assertIsArray($result);
    }

    public function testGetLocationMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $location = new Location(self::makeClient());
        $location->getLocation('');
    }
}
