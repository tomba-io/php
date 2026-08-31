<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Sources;
use Tomba\TombaException;

class SourcesTest extends TestCase
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
        $this->assertTrue(class_exists(Sources::class));
    }

    public function testEmailSources(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $sources = new Sources(self::makeClient());
        $result = $sources->emailSources('info@tomba.io');
        $this->assertIsArray($result);
    }

    public function testEmailSourcesMissingEmail(): void
    {
        $this->expectException(TombaException::class);
        $sources = new Sources(self::makeClient());
        $sources->emailSources('');
    }
}
