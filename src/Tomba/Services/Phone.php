<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Phone extends Service
{
    /**
     * Phone Finder
     *
     * Search for phone numbers associated with an email, domain, or LinkedIn profile.
     *
     * @see https://docs.tomba.io/api/phone#phone-finder
     *
     * @param array $params Associative array with keys: email, domain, or linkedin
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function phoneFinder(array $params, string $webhookUrl = null): array
    {
        if (empty($params)) {
            throw new TombaException('Missing required parameter: "params"');
        }

        $path   = '/phone-finder';

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Phone Validator
     *
     * Validate a phone number and retrieve additional information about it.
     *
     * @see https://docs.tomba.io/api/phone#phone-validator
     *
     * @param string $phone Phone number to validate
     * @param string|null $countryCode Optional country code (ISO 3166-1 alpha-2)
     * @return array API response
     * @throws TombaException
     */
    public function phoneValidator(string $phone, ?string $countryCode = null): array
    {
        if (empty($phone)) {
            throw new TombaException('Missing required parameter: "phone"');
        }

        $path   = '/phone-validator';
        $params = [];

        $params['phone'] = $phone;

        if (!is_null($countryCode)) {
            $params['country_code'] = $countryCode;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
