<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    public $incrementing = false;

    protected $fillable = [
        'id_aspirasi',
        'status',
        'id_kategori',
        'feedback',
    ];

    public function inputAspirasi(): BelongsTo
    {
        return $this->belongsTo(InputAspirasi::class, 'id_aspirasi', 'id_pelaporan');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
