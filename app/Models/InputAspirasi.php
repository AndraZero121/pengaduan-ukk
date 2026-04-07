<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';

    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'tipe',
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'foto',
        'ip_address',
    ];

    public function getMaskedIpAttribute(): string
    {
        if (! $this->ip_address) {
            return 'Unknown';
        }

        $parts = explode('.', $this->ip_address);
        if (count($parts) === 4) {
            return $parts[0].'.'.$parts[1].'.x.x';
        }

        // IPv6 masking
        $parts = explode(':', $this->ip_address);
        if (count($parts) > 1) {
            return $parts[0].':'.$parts[1].':xxxx:xxxx';
        }

        return 'xxxx.xxxx';
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function aspirasi(): HasOne
    {
        return $this->hasOne(Aspirasi::class, 'id_aspirasi', 'id_pelaporan');
    }
}
