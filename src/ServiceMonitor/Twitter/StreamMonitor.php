<?php

namespace ServiceMonitor\Twitter;

use ServiceMonitor\Monitor;

abstract class StreamMonitor extends Monitor
{
    private $accessToken;
    private $accessTokenSecret;
    private $consumerKey;
    private $consumerSecret;

    public function __construct(
        string $accessToken,
        string $accessTokenSecret,
        string $consumerKey,
        string $consumerSecret
    ) {
        $this->accessToken = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }

    public function accessTokenSecret(): string
    {
        return $this->accessTokenSecret;
    }

    public function consumerKey(): string
    {
        return $this->consumerKey;
    }

    public function consumerSecret(): string
    {
        return $this->consumerSecret;
    }
}
