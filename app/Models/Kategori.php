<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'ket_kategori',
    ];

    public function inputAspirasi(): HasMany
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }

    public function aspirasi(): HasMany
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
    }
}
