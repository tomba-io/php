<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Keys;
use Tomba\TombaException;

class KeysTest extends TestCase
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
        $this->assertTrue(class_exists(Keys::class));
    }

    public function testGetKeys(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $keys = new Keys(self::makeClient());
        $result = $keys->getKeys();
        $this->assertIsArray($result);
    }

    public function testDeleteKeyMissingId(): void
    {
        $this->expectException(TombaException::class);
        $keys = new Keys(self::makeClient());
        $keys->deleteKey('');
    }

    public function testResetKeyMissingId(): void
    {
        $this->expectException(TombaException::class);
        $keys = new Keys(self::makeClient());
        $keys->resetKey('');
    }
}
