<?php

namespace ServiceMonitor\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use ServiceMonitor\Monitor;
use Spatie\TwitterStreamingApi\PublicStream;

class SearchStreamMonitor extends Monitor
{
    private $accessToken;
    private $accessTokenSecret;
    private $consumerKey;
    private $consumerSecret;
    private $needle;

    public function __construct(
        string $accessToken,
        string $accessTokenSecret,
        string $consumerKey,
        string $consumerSecret,
        $needle
    ) {
        $this->accessToken = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->needle = $needle;
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

        $stream = new PublicStream(
            $this->accessToken,
            $this->accessTokenSecret,
            $this->consumerKey,
            $this->consumerSecret
        );
        $stream->whenHears($this->needle, function (array $event) {
            $this->execute($event);
        })
        ->startListening();
    }
}
