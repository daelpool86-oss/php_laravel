<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SayHello extends Command
{
    protected $signature = 'say:hello';
    protected $description = 'Send a GET to /say-hello every 30 seconds';

    public function handle()
    {
        $this->info('Command started. Pinging /say-hello every 30s...');

        // Base URL to ping — respects APP_URL if set, otherwise localhost:8000
        $base = config('app.url') ?: 'https://127.0.0.1:8000';
        $endpoint = rtrim($base, '/') . '/say-hello';

        while (true) {
            $this->info('Ping: ' . now()->toDateTimeString());

            try {
                $response = Http::timeout(10)->get($endpoint);
                $status = $response->status();
                $this->info("Pinged {$endpoint} — status {$status}");
            } catch (\Throwable $e) {
                $this->error('Request failed: ' . $e->getMessage());
            }

            sleep(30);
        }
    }
}
