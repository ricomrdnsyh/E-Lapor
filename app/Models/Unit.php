<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';

    protected $primaryKey = 'id_unit';

    protected $fillable = [
        'nama_unit',
        'singkatan'
    ];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'unit_id', 'id_unit');
    }
}
