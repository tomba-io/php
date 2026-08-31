<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Phone;
use Tomba\TombaException;

class PhoneTest extends TestCase
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
        $this->assertTrue(class_exists(Phone::class));
    }

    public function testPhoneFinder(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $phone = new Phone(self::makeClient());
        $result = $phone->phoneFinder(['email' => 'info@tomba.io']);
        $this->assertIsArray($result);
    }

    public function testPhoneFinderMissingParams(): void
    {
        $this->expectException(TombaException::class);
        $phone = new Phone(self::makeClient());
        $phone->phoneFinder([]);
    }

    public function testPhoneValidator(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $phone = new Phone(self::makeClient());
        $result = $phone->phoneValidator('+16502530000', 'US');
        $this->assertIsArray($result);
    }

    public function testPhoneValidatorMissingPhone(): void
    {
        $this->expectException(TombaException::class);
        $phone = new Phone(self::makeClient());
        $phone->phoneValidator('');
    }
}
