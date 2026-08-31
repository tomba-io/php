<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Verifier;
use Tomba\TombaException;

class VerifierTest extends TestCase
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
        $this->assertTrue(class_exists(Verifier::class));
    }

    public function testEmailVerifier(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $verifier = new Verifier(self::makeClient());
        $result = $verifier->emailVerifier('info@tomba.io');
        $this->assertIsArray($result);
    }

    public function testEmailVerifierMissingEmail(): void
    {
        $this->expectException(TombaException::class);
        $verifier = new Verifier(self::makeClient());
        $verifier->emailVerifier('');
    }
}
