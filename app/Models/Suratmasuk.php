<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratmasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';
    protected $primaryKey = 'no_surat';
    protected $fillable = [
        'no_surat',
        'no_agenda',
        'jenis_surat',
        'tanggal_kirim',
        'tanggal_terima',
        'pengirim',
        'perihal',
        'surat'
    ];

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'no_surat', 'no_surat');
    }
}
