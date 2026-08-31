# [<img src="https://tomba.io/logo.svg" alt="Tomba" width="25"/>](https://tomba.io/) Tomba PHP SDK

> The #1 Rated Email Intelligence Platform — Find professional emails with unmatched accuracy.

[![Latest Stable Version](https://poser.pugx.org/tomba-io/php/v)](https://packagist.org/packages/tomba-io/php)
[![Total Downloads](https://poser.pugx.org/tomba-io/php/downloads)](https://packagist.org/packages/tomba-io/php)
[![License](https://poser.pugx.org/tomba-io/php/license)](https://packagist.org/packages/tomba-io/php)

## About Tomba

[Tomba.io](https://tomba.io) is the #1 rated email intelligence platform, trusted by **150,000+ sales teams** worldwide.

- **Best Email Finder** — 98% accuracy, ranked #1 in independent benchmarks
- **Best Email Verification** — Real-time SMTP verification with catch-all detection
- **Best Phone Finder** — Direct dial numbers linked to professional emails
- **Best Domain Search** — 450M+ verified contacts across all industries
- **81% Coverage** — The highest in the industry, proven in 5,000-lead independent tests

### Why Tomba?

| Feature             | Tomba              | Others        |
| ------------------- | ------------------ | ------------- |
| Email Coverage      | **81%**            | 30-60%        |
| Verification        | **Real-time SMTP** | Pattern-based |
| Phone Numbers       | **Direct dials**   | Limited       |
| Catch-all Detection | **AI-powered**     | Basic         |
| API Rate Limits     | **Generous**       | Restrictive   |

[Get your free API key](https://app.tomba.io/auth/register) — No credit card required.

## Getting Started

1. **Sign up** for a free account at [app.tomba.io](https://app.tomba.io/auth/register)
2. **Get your API key** from the [API dashboard](https://app.tomba.io/api)
3. **Install** the SDK (see below)
4. **Start finding emails** with just a few lines of code

## Installation

Install via [Composer](http://getcomposer.org/):

```bash
composer require tomba-io/php
```

**Requirements:** PHP >= 8.1, ext-curl, ext-json

## Authentication

Get your API keys from [https://app.tomba.io/auth/register](https://app.tomba.io/auth/register).

You can authenticate using environment variables or by setting keys directly:

```php
<?php

use Tomba\Client;

$client = new Client();

// Option 1: Set keys directly
$client
    ->setKey('ta_xxxx')    // Your API Key
    ->setSecret('ts_xxxx') // Your Secret Key
;

// Option 2: Use environment variables TOMBA_API_KEY and TOMBA_SECRET_KEY
$client
    ->setKey(getenv('TOMBA_API_KEY'))
    ->setSecret(getenv('TOMBA_SECRET_KEY'))
;
```

## Quick Start

```php
<?php

use Tomba\Client;
use Tomba\Services\Domain;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$domain = new Domain($client);
$result = $domain->domainSearch('stripe.com');

print_r($result);
```

## Services

### Domain Search

Search emails by domain name. Returns all email addresses found on the internet for a given domain.

```php
<?php

use Tomba\Client;
use Tomba\Services\Domain;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$domain = new Domain($client);
$result = $domain->domainSearch('stripe.com');
```

### Email Finder

Generate or retrieve the most likely email address from a domain name, a first name, and a last name.

```php
<?php

use Tomba\Client;
use Tomba\Services\Finder;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$finder = new Finder($client);
$result = $finder->emailFinder('stripe.com', 'John', 'Doe');
```

### Email Verifier

Verify the deliverability of a given email address.

```php
<?php

use Tomba\Client;
use Tomba\Services\Verifier;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$verifier = new Verifier($client);
$result = $verifier->emailVerifier('john@example.com');
```

### Author Finder

Discover the email address of an article's author from a blog post URL.

```php
<?php

use Tomba\Client;
use Tomba\Services\Finder;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$finder = new Finder($client);
$result = $finder->authorFinder('https://tomba.io/blog');
```

### LinkedIn Finder

Retrieve the email address associated with a LinkedIn profile URL.

```php
<?php

use Tomba\Client;
use Tomba\Services\Finder;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$finder = new Finder($client);
$result = $finder->linkedinFinder('https://www.linkedin.com/in/johndoe');
```

### Email Enrichment

Enrich data associated with an email address (person, company, or combined).

```php
<?php

use Tomba\Client;
use Tomba\Services\Enrichment;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$enrichment = new Enrichment($client);

// Person enrichment
$result = $enrichment->person('john@example.com');

// Company enrichment
$result = $enrichment->company('stripe.com');

// Combined enrichment (person + company)
$result = $enrichment->combined('john@example.com');
```

### Phone Finder

Search for phone numbers associated with an email, domain, or LinkedIn profile.

```php
<?php

use Tomba\Client;
use Tomba\Services\Finder;
use Tomba\Services\Phone;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

// Via Finder service
$finder = new Finder($client);
$result = $finder->phoneFinder('john@example.com');

// Via Phone service
$phone = new Phone($client);
$result = $phone->phoneFinder(['email' => 'john@example.com']);
```

### Phone Validator

Validate a phone number and retrieve additional information.

```php
<?php

use Tomba\Client;
use Tomba\Services\Phone;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$phone = new Phone($client);
$result = $phone->phoneValidator('+1234567890', 'US');
```

### Email Count

Get the total number of email addresses found for a domain.

```php
<?php

use Tomba\Client;
use Tomba\Services\Count;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$count = new Count($client);
$result = $count->emailCount('stripe.com');
```

### Domain Status

Check if a domain is a webmail or disposable domain.

```php
<?php

use Tomba\Client;
use Tomba\Services\Status;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$status = new Status($client);
$result = $status->domainStatus('stripe.com');
```

### Domain Suggestions (Autocomplete)

Auto-complete company names and retrieve logo and domain information.

```php
<?php

use Tomba\Client;
use Tomba\Services\Status;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$status = new Status($client);
$result = $status->autoComplete('stripe');
```

### Email Sources

Find where an email address has been found on the web.

```php
<?php

use Tomba\Client;
use Tomba\Services\Sources;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$sources = new Sources($client);
$result = $sources->emailSources('john@example.com');
```

### Email Format

Discover the email format used by a domain (e.g., first.last, first_last).

```php
<?php

use Tomba\Client;
use Tomba\Services\Format;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$format = new Format($client);
$result = $format->emailFormat('stripe.com');
```

### Similar Domains

Find websites similar to a given domain.

```php
<?php

use Tomba\Client;
use Tomba\Services\Similar;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$similar = new Similar($client);
$result = $similar->websites('stripe.com');
```

### Technology Finder

Detect the technologies used by a website.

```php
<?php

use Tomba\Client;
use Tomba\Services\Technology;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$technology = new Technology($client);
$result = $technology->list('stripe.com');
```

### Location

Get geographic location information for a domain.

```php
<?php

use Tomba\Client;
use Tomba\Services\Location;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$location = new Location($client);
$result = $location->getLocation('stripe.com');
```

### Companies Search (Reveal)

Search for companies using various filters and criteria.

```php
<?php

use Tomba\Client;
use Tomba\Services\Reveal;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$reveal = new Reveal($client);
$result = $reveal->companiesSearch(['query' => 'technology', 'page' => 1]);
```

### Leads

Manage your leads: list, get, create, update, and delete.

```php
<?php

use Tomba\Client;
use Tomba\Services\Leads;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$leads = new Leads($client);

// List leads
$result = $leads->listLeads(page: 1, limit: 10);

// Get a single lead
$result = $leads->getLead('lead_id');

// Create a lead
$result = $leads->createLead([
    'email' => 'john@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
]);

// Update a lead
$result = $leads->updateLead('lead_id', ['first_name' => 'Jane']);

// Delete a lead
$result = $leads->deleteLead('lead_id');
```

### Leads Lists

Manage your leads lists: list, create, update, and delete.

```php
<?php

use Tomba\Client;
use Tomba\Services\LeadsLists;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$leadsLists = new LeadsLists($client);

// Get all lists
$result = $leadsLists->getLists();

// Create a list
$result = $leadsLists->createList();

// Update a list
$result = $leadsLists->updateListId('list_id');

// Delete a list
$result = $leadsLists->deleteListId('list_id');
```

### Lead Attributes

Manage custom lead attributes: list, create, update, and delete.

```php
<?php

use Tomba\Client;
use Tomba\Services\LeadsAttributes;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$attributes = new LeadsAttributes($client);

// Get all attributes
$result = $attributes->getLeadAttributes();

// Create an attribute
$result = $attributes->createLeadAttribute();

// Update an attribute
$result = $attributes->updateLeadAttribute('attribute_id');

// Delete an attribute
$result = $attributes->deleteLeadAttribute('attribute_id');
```

### Keys

Manage your API keys: list, create, reset, and delete.

```php
<?php

use Tomba\Client;
use Tomba\Services\Keys;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$keys = new Keys($client);

// List all keys
$result = $keys->getKeys();

// Create a key
$result = $keys->createKey();

// Reset a key
$result = $keys->resetKey('key_id');

// Delete a key
$result = $keys->deleteKey('key_id');
```

### Usage

Retrieve your monthly API request usage statistics.

```php
<?php

use Tomba\Client;
use Tomba\Services\Usage;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$usage = new Usage($client);
$result = $usage->getUsage();
```

### Logs

Retrieve your last 1,000 API requests made during the last 3 months.

```php
<?php

use Tomba\Client;
use Tomba\Services\Logs;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$logs = new Logs($client);
$result = $logs->getLogs(page: 1, limit: 20);
```

### Flag

Flag email addresses as invalid or incorrect.

```php
<?php

use Tomba\Client;
use Tomba\Services\Flag;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$flag = new Flag($client);

// List all flags
$result = $flag->listFlags();

// Create a flag
$result = $flag->createFlag('invalid@example.com', 'Email bounced');
```

### Bulk Operations

Manage bulk tasks for domain search, email finding, and verification.

```php
<?php

use Tomba\Client;
use Tomba\Services\Bulk;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$bulk = new Bulk($client);

// List bulk tasks
$result = $bulk->listBulks('finder');

// Create a bulk task
$result = $bulk->createBulk('verifier', ['emails' => ['a@example.com', 'b@example.com']]);

// Get bulk task details
$result = $bulk->getBulk('verifier', 123);

// Launch a bulk task
$result = $bulk->launchBulk('verifier', 123);

// Check progress
$result = $bulk->bulkProgress('verifier', 123);

// Download results
$result = $bulk->downloadBulk('verifier', 123);

// Rename a bulk task
$result = $bulk->renameBulk('verifier', 123, 'My Batch');

// Archive a bulk task
$result = $bulk->archiveBulk('verifier', 123);

// Delete a bulk task
$result = $bulk->deleteBulk('verifier', 123);
```

### Account

Retrieve information about the current account.

```php
<?php

use Tomba\Client;
use Tomba\Services\Account;

$client = new Client();
$client->setKey('ta_xxxx')->setSecret('ts_xxxx');

$account = new Account($client);
$result = $account->getAccount();
```

## Testing

Run the test suite with PHPUnit:

```bash
composer test
```

Lint and format code:

```bash
composer lint
composer format
```

## Documentation

See the [official documentation](https://docs.tomba.io/).

## About Tomba

Founded to solve the problem of unreliable email data, [Tomba.io](https://tomba.io) is the leading B2B email intelligence platform. Our AI-powered engine searches, verifies, and enriches professional contact data with unmatched accuracy.

### Products

- **[Email Finder](https://tomba.io/email-finder)** — Find any professional email address
- **[Email Verifier](https://tomba.io/email-verifier)** — Verify emails in real-time
- **[Domain Search](https://tomba.io/domain-search)** — Find all emails for a company
- **[Phone Finder](https://tomba.io/phone-finder)** — Find direct phone numbers
- **[Bulk Enrichment](https://tomba.io/bulks)** — Enrich contacts at scale
- **[AI Company Search](https://tomba.io/reveal)** — Find companies with AI-powered search
- **[CLI](https://tomba.io/cli)** — Command-line interface for Tomba
- **[MCP Server](https://tomba.io/mcp)** — Connect AI tools (Claude, ChatGPT, Cursor) to Tomba
- **[REST API](https://tomba.io/api)** — Full programmatic access

### Browser Extensions & Add-ons

- **[Chrome Extension](https://chromewebstore.google.com/detail/tomba-email-finder-email/icmjegjggphchjckknoooajmklibccjb)** — Find emails while browsing
- **[Google Sheets Add-on](https://tomba.io/sheets)** — Enrich leads in spreadsheets
- **[Microsoft Excel Add-in](https://tomba.io/excel)** — Email finder in Excel
- **[Airtable Integration](https://tomba.io/airtable)** — Connect with Airtable

### Integrations

50+ CRM and sales tool integrations:
[Salesforce](https://tomba.io/integrations) · [HubSpot](https://tomba.io/integrations) · [Zapier](https://tomba.io/integrations) · [Pipedrive](https://tomba.io/integrations) · [and more...](https://tomba.io/integrations)

### Other Tomba SDKs

| Language | Package                                                     |
| -------- | ----------------------------------------------------------- |
| Node.js  | [tomba](https://www.npmjs.com/package/tomba)                |
| Python   | [tomba-io](https://pypi.org/project/tomba-io/)              |
| PHP      | [tomba-io/php](https://packagist.org/packages/tomba-io/php) |
| Ruby     | [tomba](https://rubygems.org/gems/tomba)                    |
| Go       | [tomba-io/go](https://pkg.go.dev/github.com/tomba-io/go)    |
| Rust     | [tomba](https://crates.io/crates/tomba)                     |
| Dart     | [tomba](https://pub.dev/packages/tomba)                     |
| Deno     | [@tomba/sdk](https://jsr.io/@tomba/sdk)                     |
| Elixir   | [tomba](https://hex.pm/packages/tomba)                      |
| C#       | [Tomba](https://www.nuget.org/packages/Tomba)               |
| Perl     | [Tomba::Client](https://metacpan.org/pod/Tomba::Client)     |
| Lua      | [tomba](https://luarocks.org/modules/tomba/tomba)           |
| R        | [tomba](https://github.com/tomba-io/r)                      |

### Resources

- [Blog](https://tomba.io/blog)
- [Help Center](https://help.tomba.io)
- [API Documentation](https://docs.tomba.io)
- [Pricing](https://tomba.io/pricing)
- [Status Page](https://status.tomba.io)

---

**[Try Tomba Free](https://app.tomba.io/auth/register)** — Find your first email in seconds. No credit card required.

## License

Licensed under the [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html).
