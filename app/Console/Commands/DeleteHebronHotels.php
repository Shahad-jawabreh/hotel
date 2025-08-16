<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Hotel ;
class DeleteHebronHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotels:delete-hebron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedCount = Hotel::where('location', 'hebron')->delete();

        $this->info("Deleted $deletedCount hotels in Hebron successfully.");
    }
    
}
