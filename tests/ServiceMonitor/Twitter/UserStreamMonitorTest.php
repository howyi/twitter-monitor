<?php

namespace ServiceMonitor\Twitter;

use Mockery as m;
use Spatie\TwitterStreamingApi\UserStream;

class UserStreamMonitorTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testStart(): void
    {
        $monitor = new UserStreamMonitor(
            'TWITTER_ACCESS_TOKEN',
            'TWITTER_ACCESS_TOKEN_SECRET',
            'TWITTER_CONSUMER_KEY',
            'TWITTER_CONSUMER_SECRET'
        );

        $stream = m::mock('overload:\Spatie\TwitterStreamingApi\UserStream');
        $stream->expects()->onEvent(m::type(\Closure::class))->once()->andReturn($eventedStream = m::mock('overload:\Spatie\TwitterStreamingApi\UserStream'));
        $eventedStream->expects()->startListening()->once();

        $monitor->start();
        $this->assertSame($monitor, $monitor);
    }
}
