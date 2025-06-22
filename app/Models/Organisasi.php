<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi';
    
    protected $fillable = [
        'nama_organisasi',
        'jenis',
    ];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'organisasi_id');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'organisasi_id');
    }
}