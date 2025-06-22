<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    
    protected $fillable = [
        'nama',
        'tgl_pelaksanaan',
        'organisasi_id',
        'lokasi_id',
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'date',
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'organisasi_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function kepanitiaan()
    {
        return $this->hasMany(Kepanitiaan::class, 'kegiatan_id');
    }
}