<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'kelas',
    ];

    public function inputAspirasi(): HasMany
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}
