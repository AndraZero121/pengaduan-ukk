<?php

namespace App\Console\Commands;

use App\Models\Aspirasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ArchiveLaporan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-laporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arsip laporan yang sudah selesai lebih dari 30 hari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai proses pengarsipan...');

        $aspirasiToArchive = Aspirasi::query()
            ->where('status', 'Selesai')
            ->where('updated_at', '<', now()->subDays(30))
            ->whereNull('archived_at')
            ->get();

        $count = $aspirasiToArchive->count();

        if ($count === 0) {
            $this->info('Tidak ada laporan lama yang perlu diarsipkan.');

            return;
        }

        $this->info("Menemukan {$count} laporan untuk diarsipkan.");

        foreach ($aspirasiToArchive as $aspirasi) {
            $aspirasi->update(['archived_at' => now()]);
        }

        Log::info("Mengarsipkan {$count} laporan lama yang sudah selesai.");
        $this->info('Proses pengarsipan selesai dengan sukses.');
    }
}
