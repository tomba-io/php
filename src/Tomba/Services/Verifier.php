<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Verifier extends Service
{
    /**
     * Email Verifier
     *
     * Verify the deliverability of an email address.
     *
     * @see https://docs.tomba.io/api/verifier#email-verifier
     *
     * @param string $email Email address to verify
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function emailVerifier(string $email, string $webhookUrl = null): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/email-verifier';
        $params = [];

        $params['email'] = $email;

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }
}
