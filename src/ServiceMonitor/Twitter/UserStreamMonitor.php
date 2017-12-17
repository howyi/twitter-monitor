<?php

namespace ServiceMonitor\Twitter;

use Spatie\TwitterStreamingApi\UserStream;

class UserStreamMonitor extends StreamMonitor
{
    public function start(): void
    {
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
