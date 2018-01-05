<?php

namespace ServiceMonitor\Twitter;

use ServiceMonitor\EventInterface;

class SampleEvent extends TwitterEvent
{
    public function isExecutable(array $value): bool
    {
        if (!isset($value['in_reply_to_user_id_str']) or !isset($value['text'])) {
            return false;
        }

        if ($value['in_reply_to_user_id_str'] !== $this->self->id_str) {
            return false;
        }

        return (strpos($value['text'], 'hello') !== false);
    }

    public function execute(array $value): void
    {
        echo("User:@{$value['user']['screen_name']} greeted :)" . PHP_EOL);

        $status = "Hello, @{$value['user']['screen_name']} !";

        $this->connection->post(
            'statuses/update',
            ['in_reply_to_status_id'=> $value['id_str'], 'status' => $status]
        );
    }
}
