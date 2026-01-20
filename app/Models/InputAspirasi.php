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
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
    ];

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
