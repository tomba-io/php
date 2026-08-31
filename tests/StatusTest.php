<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Status;
use Tomba\TombaException;

class StatusTest extends TestCase
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
        $this->assertTrue(class_exists(Status::class));
    }

    public function testDomainStatus(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $status = new Status(self::makeClient());
        $result = $status->domainStatus('tomba.io');
        $this->assertIsArray($result);
    }

    public function testAutoComplete(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $status = new Status(self::makeClient());
        $result = $status->autoComplete('tomba');
        $this->assertIsArray($result);
    }

    public function testDomainStatusMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $status = new Status(self::makeClient());
        $status->domainStatus('');
    }
}
