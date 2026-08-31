<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Similar;
use Tomba\TombaException;

class SimilarTest extends TestCase
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
        $this->assertTrue(class_exists(Similar::class));
    }

    public function testWebsites(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $similar = new Similar(self::makeClient());
        $result = $similar->websites('tomba.io');
        $this->assertIsArray($result);
    }

    public function testWebsitesMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $similar = new Similar(self::makeClient());
        $similar->websites('');
    }
}
