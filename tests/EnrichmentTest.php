<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Enrichment;
use Tomba\TombaException;

class EnrichmentTest extends TestCase
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
        $this->assertTrue(class_exists(Enrichment::class));
    }

    public function testPerson(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $enrichment = new Enrichment(self::makeClient());
        $result = $enrichment->person('info@tomba.io');
        $this->assertIsArray($result);
    }

    public function testPersonMissingEmail(): void
    {
        $this->expectException(TombaException::class);
        $enrichment = new Enrichment(self::makeClient());
        $enrichment->person('');
    }

    public function testCompany(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $enrichment = new Enrichment(self::makeClient());
        $result = $enrichment->company('tomba.io');
        $this->assertIsArray($result);
    }

    public function testCompanyMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $enrichment = new Enrichment(self::makeClient());
        $enrichment->company('');
    }

    public function testCombined(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $enrichment = new Enrichment(self::makeClient());
        $result = $enrichment->combined('info@tomba.io');
        $this->assertIsArray($result);
    }

    public function testCombinedMissingEmail(): void
    {
        $this->expectException(TombaException::class);
        $enrichment = new Enrichment(self::makeClient());
        $enrichment->combined('');
    }
}
