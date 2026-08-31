<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Reveal;
use Tomba\TombaException;

class RevealTest extends TestCase
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
        $this->assertTrue(class_exists(Reveal::class));
    }

    public function testCompaniesSearch(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $reveal = new Reveal(self::makeClient());
        $result = $reveal->companiesSearch([
            'filters' => [
                'location_country' => ['include' => ['US']],
            ],
            'page' => 1,
        ]);
        $this->assertIsArray($result);
    }

    public function testCompaniesSearchMissingParams(): void
    {
        $this->expectException(TombaException::class);
        $reveal = new Reveal(self::makeClient());
        $reveal->companiesSearch([]);
    }
}
