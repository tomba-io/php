<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Flag;
use Tomba\TombaException;

class FlagTest extends TestCase
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
        $this->assertTrue(class_exists(Flag::class));
    }

    public function testListFlags(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $flag = new Flag(self::makeClient());
        $result = $flag->listFlags();
        $this->assertIsArray($result);
    }

    public function testCreateFlagMissingFlagType(): void
    {
        $this->expectException(TombaException::class);
        $flag = new Flag(self::makeClient());
        $flag->createFlag('', 'test@example.com', 'spam');
    }
}
