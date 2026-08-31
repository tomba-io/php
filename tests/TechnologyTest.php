<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Technology;
use Tomba\TombaException;

class TechnologyTest extends TestCase
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
        $this->assertTrue(class_exists(Technology::class));
    }

    public function testList(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $technology = new Technology(self::makeClient());
        $result = $technology->list('tomba.io');
        $this->assertIsArray($result);
    }

    public function testListMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $technology = new Technology(self::makeClient());
        $technology->list('');
    }
}
