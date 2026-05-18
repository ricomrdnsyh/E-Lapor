<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    protected $table = 'lantai';

    protected $primaryKey = 'id_lantai';

    protected $fillable = [
        'gedung_id',
        'nama_lantai',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'id_gedung');
    }

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'lantai_id', 'id_lantai');
    }
}
