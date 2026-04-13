<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jalankan server dan scheduler secara bersamaan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai server Laravel dan Scheduler...');

        $serve = new Process(['php', 'artisan', 'serve']);
        $schedule = new Process(['php', 'artisan', 'schedule:work']);

        $serve->setTimeout(null);
        $schedule->setTimeout(null);

        $serve->start();
        $this->info('✓ Server berjalan di http://127.0.0.1:8000');
        
        $schedule->start();
        $this->info('✓ Scheduler (Work) sedang berjalan...');

        // Tunggu hingga salah satu proses berhenti
        while ($serve->isRunning() && $schedule->isRunning()) {
            usleep(500000); // 0.5 detik
        }

        $this->info('Server atau Scheduler dihentikan.');
    }
}
