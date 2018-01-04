<?php

namespace ServiceMonitor\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Spatie\TwitterStreamingApi\UserStream;

class UserStreamMonitor extends StreamMonitor
{
    public function start(): void
    {
        $connection = new TwitterOAuth(
            $this->consumerKey(),
            $this->consumerSecret(),
            $this->accessToken(),
            $this->accessTokenSecret()
        );

        $self = $connection->get('account/verify_credentials');

        foreach ($this->events as $event) {
            $event->set($connection, $self);
        }

        $stream = new UserStream(
            $this->accessToken(),
            $this->accessTokenSecret(),
            $this->consumerKey(),
            $this->consumerSecret()
        );
        $stream->onEvent(function (array $event) {
            $this->execute($event);
        })
        ->startListening();
    }
}
