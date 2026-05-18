<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';

    protected $primaryKey = 'id_gedung';

    protected $fillable = [
        'nama_gedung',
        'deskripsi',
    ];

    public function lantai()
    {
        return $this->hasMany(Lantai::class, 'gedung_id', 'id_gedung');
    }
}
