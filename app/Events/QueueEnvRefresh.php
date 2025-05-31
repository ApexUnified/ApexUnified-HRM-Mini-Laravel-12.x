<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class QueueEnvRefresh implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    protected  $key;
    protected  $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function handle()
    {

        $env = base_path(".env");
        if (File::exists($env)) {
            file_put_contents($env, preg_replace(
                "/^{$this->key}=.*/m",
                "{$this->key}=" . (str_contains($this->value, ' ') ? "\"{$this->value}\"" : $this->value),
                file_get_contents($env)
            ));
        }

        Artisan::call("config:clear");
        Artisan::call("cache:clear");
    }
}
