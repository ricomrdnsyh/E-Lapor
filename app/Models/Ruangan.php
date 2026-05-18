<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    protected $primaryKey = 'id_ruangan';

    protected $fillable = [
        'lantai_id',
        'nama_ruangan',
        'jenis_ruangan',
    ];

    public function lantai()
    {
        return $this->belongsTo(Lantai::class, 'lantai_id', 'id_lantai');
    }

    public function fungsiRuangan()
    {
        return $this->belongsTo(FungsiRuangan::class, 'jenis_ruangan', 'id_fungsi');
    }
}
