<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Finder;
use Tomba\TombaException;

class FinderTest extends TestCase
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
        $this->assertTrue(class_exists(Finder::class));
    }

    public function testEmailFinder(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $finder = new Finder(self::makeClient());
        $result = $finder->emailFinder('tomba.io', 'Mohamed', 'Ben Rebia');
        $this->assertIsArray($result);
    }

    public function testEmailFinderMissingDomain(): void
    {
        $this->expectException(TombaException::class);
        $finder = new Finder(self::makeClient());
        $finder->emailFinder('', 'Mohamed', 'Ben Rebia');
    }

    public function testAuthorFinder(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $finder = new Finder(self::makeClient());
        $result = $finder->authorFinder('https://example.com/blog/post');
        $this->assertIsArray($result);
    }

    public function testLinkedinFinder(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $finder = new Finder(self::makeClient());
        $result = $finder->linkedinFinder('https://www.linkedin.com/in/example');
        $this->assertIsArray($result);
    }

    public function testPhoneFinder(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $finder = new Finder(self::makeClient());
        $result = $finder->phoneFinder('info@tomba.io');
        $this->assertIsArray($result);
    }
}
