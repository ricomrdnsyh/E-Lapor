<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'unit_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id_unit');
    }
}
