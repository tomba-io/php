<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Format;
use Tomba\TombaException;

class FormatTest extends TestCase
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
        $this->assertTrue(class_exists(Format::class));
    }

    public function testEmailFormat(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $format = new Format(self::makeClient());
        $result = $format->emailFormat('tomba.io');
        $this->assertIsArray($result);
    }

    public function testEmailFormatMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $format = new Format(self::makeClient());
        $format->emailFormat('');
    }
}
