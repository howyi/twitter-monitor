<?php

namespace ServiceMonitor\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use ServiceMonitor\EventInterface;

abstract class TwitterEvent implements EventInterface
{
    protected $connection;
    protected $self;

    public function set(TwitterOAuth $connection, \stdClass $self): void
    {
        $this->connection = $connection;
        $this->self = $self;
    }
}
