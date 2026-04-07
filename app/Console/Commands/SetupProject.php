<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\spin;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup project: copy .env, generate key, migrate and seed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('Project Setup');

        if (! File::exists('.env')) {
            $copyEnv = confirm('File .env tidak ditemukan. Salin dari .env.example?', true);
            if ($copyEnv) {
                File::copy('.env.example', '.env');
                info('.env berhasil disalin.');
            }
        }

        spin(function () {
            $this->callSilent('key:generate');
        }, 'Generating App Key...');
        info('App Key berhasil dibuat.');

        $shouldMigrate = confirm('Apakah Anda ingin menjalankan migrasi dan seed?', true);

        if ($shouldMigrate) {
            $fresh = confirm('Ingin menjalankan migrate:fresh? (Ini akan menghapus semua data yang ada)', false);

            spin(function () use ($fresh) {
                if ($fresh) {
                    $this->callSilent('migrate:fresh', ['--seed' => true, '--force' => true]);
                } else {
                    $this->callSilent('migrate', ['--seed' => true, '--force' => true]);
                }
            }, 'Menjalankan migrasi dan seeding...');

            info('Migrasi dan seeding berhasil diselesaikan.');
        }

        info('Setup Proyek Selesai!');
    }
}
