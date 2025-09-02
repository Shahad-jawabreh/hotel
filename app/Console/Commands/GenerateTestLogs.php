<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;

use Illuminate\Console\Command;

class GenerateTestLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-test-logs';
    protected $description = 'Generates various types of log messages for testing.';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
     public function handle()
    {
        $this->info('Generating test logs...');

        Log::info('This is an INFO log message.');
        Log::warning('This is a WARNING log message with a warning!');
        Log::error('An error occurred during a test process.');

        Log::info('A user just logged in.', ['user_id' => 123, 'ip' => '192.168.1.1']);

        // Simulate an API request with a duration
        Log::info("API Request", [
            'method' => 'GET',
            'url' => 'http://localhost/api/hotels/1',
            'status' => 200,
            'duration_ms' => mt_rand(50, 5000), // Random duration
        ]);

        $this->info('Done generating test logs.');
    }
}
