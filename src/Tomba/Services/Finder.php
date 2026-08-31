<?php

namespace Tomba\Services;

use Tomba\Client;
use Tomba\Service;
use Tomba\TombaException;

class Finder extends Service
{
    /**
     * Email Finder
     *
     * Generates or retrieves the most likely email address from a domain name,
     * a first name and a last name.
     *
     * @see https://docs.tomba.io/api/finder#email-finder
     *
     * @param string $domain Domain name
     * @param string $firstName First name
     * @param string $lastName Last name
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function emailFinder(string $domain, string $firstName, string $lastName, string $webhookUrl = null): array
    {
        if (empty($domain)) {
            throw new TombaException('Missing required parameter: "domain"');
        }

        if (empty($firstName)) {
            throw new TombaException('Missing required parameter: "firstName"');
        }

        if (empty($lastName)) {
            throw new TombaException('Missing required parameter: "lastName"');
        }

        $path   = '/email-finder';
        $params = [];

        $params['first_name'] = $firstName;
        $params['last_name'] = $lastName;
        $params['domain'] = $domain;

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Author Finder
     *
     * Generates or retrieves the most likely email address from a blog post URL.
     *
     * @see https://docs.tomba.io/api/finder#author-finder
     *
     * @param string $url Blog post URL
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function authorFinder(string $url, string $webhookUrl = null): array
    {
        if (empty($url)) {
            throw new TombaException('Missing required parameter: "url"');
        }

        $path   = '/author-finder';
        $params = [];

        $params['url'] = $url;

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * LinkedIn Finder
     *
     * Generates or retrieves the most likely email address from a LinkedIn URL.
     *
     * @see https://docs.tomba.io/api/finder#linkedin-finder
     *
     * @param string $url LinkedIn profile URL
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function linkedinFinder(string $url, string $webhookUrl = null): array
    {
        if (empty($url)) {
            throw new TombaException('Missing required parameter: "url"');
        }

        $path   = '/linkedin';
        $params = [];

        $params['url'] = $url;

        if (!is_null($webhookUrl)) {
            $params['webhook_url'] = $webhookUrl;
        }

        return $this->client->call(Client::METHOD_GET, $path, [
            'content-type' => 'application/json',
        ], $params);
    }

    /**
     * Phone Finder
     *
     * Search phone data based on the email address provided.
     *
     * @see https://docs.tomba.io/api/finder#phone-finder
     *
     * @param string $email Email address to search phone for
     * @param string|null $webhookUrl Webhook URL for async notifications
     * @return array API response
     * @throws TombaException
     */
    public function phoneFinder(string $email, string $webhookUrl = null): array
    {
        if (empty($email)) {
            throw new TombaException('Missing required parameter: "email"');
        }

        $path   = '/phone-finder';
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
