<?php

namespace Tomba\Tests;

use PHPUnit\Framework\TestCase;
use Tomba\Client;
use Tomba\Services\Leads;
use Tomba\TombaException;

class LeadsTest extends TestCase
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
        $this->assertTrue(class_exists(Leads::class));
    }

    public function testListLeads(): void
    {
        if (!self::hasCredentials()) {
            $this->markTestSkipped('No API credentials');
        }
        $leads = new Leads(self::makeClient());
        $result = $leads->listLeads();
        $this->assertIsArray($result);
    }

    public function testGetLeadMissingId(): void
    {
        $this->expectException(TombaException::class);
        $leads = new Leads(self::makeClient());
        $leads->getLead('');
    }

    public function testCreateLeadMissingData(): void
    {
        $this->expectException(TombaException::class);
        $leads = new Leads(self::makeClient());
        $leads->createLead([]);
    }

    public function testUpdateLeadMissingId(): void
    {
        $this->expectException(TombaException::class);
        $leads = new Leads(self::makeClient());
        $leads->updateLead('', ['email' => 'test@example.com']);
    }

    public function testDeleteLeadMissingId(): void
    {
        $this->expectException(TombaException::class);
        $leads = new Leads(self::makeClient());
        $leads->deleteLead('');
    }
}
