<?php

namespace ServiceMonitor\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use ServiceMonitor\Monitor;
use Spatie\TwitterStreamingApi\UserStream;

class UserStreamMonitor extends Monitor
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

    public function start(): void
    {
        $connection = new TwitterOAuth(
            $this->consumerKey,
            $this->consumerSecret,
            $this->accessToken,
            $this->accessTokenSecret
        );

        $self = $connection->get('account/verify_credentials');

        foreach ($this->events as $event) {
            $event->set($connection, $self);
        }

        $stream = new UserStream(
            $this->accessToken,
            $this->accessTokenSecret,
            $this->consumerKey,
            $this->consumerSecret
        );
        $stream->onEvent(function (array $event) {
            $this->execute($event);
        })
        ->startListening();
    }
}
