# twitter-monitor
Twitter Stream monitoring tool

## Start monitoring
```php
$monitor = new \ServiceMonitor\Twitter\UserStreamMonitor(
    getenv('TWITTER_ACCESS_TOKEN'),
    getenv('TWITTER_ACCESS_TOKEN_SECRET'),
    getenv('TWITTER_CONSUMER_KEY'),
    getenv('TWITTER_CONSUMER_SECRET')
);

$event = new class extends \ServiceMonitor\Twitter\TwitterEvent {
    public function isExecutable(array $value): bool { return true; }
    // All events execute

    public function execute(array $value): void
    {
        echo("New Event has arrived :)" . PHP_EOL);
        var_dump($value);
    }
};

$monitor->setEvent($event);
$monitor->start();
```
