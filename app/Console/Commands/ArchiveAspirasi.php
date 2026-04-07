<?php

namespace App\Console\Commands;

use App\Models\Aspirasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ArchiveAspirasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-aspirasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive completed aspirations older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting archive process...');

        $aspirasiToArchive = Aspirasi::query()
            ->where('status', 'Selesai')
            ->where('updated_at', '<', now()->subDays(30))
            ->whereNull('archived_at')
            ->get();

        $count = $aspirasiToArchive->count();

        if ($count === 0) {
            $this->info('No old completed aspirations found to archive.');

            return;
        }

        $this->info("Found {$count} aspirations to archive.");

        foreach ($aspirasiToArchive as $aspirasi) {
            $aspirasi->update(['archived_at' => now()]);
        }

        Log::info("Archived {$count} old completed aspirations.");
        $this->info('Archive process completed successfully.');
    }
}
