<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';

    protected $primaryKey = 'id_unit';

    protected $fillable = [
        'id_unit',
        'nama_unit',
        'singkatan',
        'status'
    ];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'unit_id', 'id_unit');
    }

    public function subKategoris()
    {
        return $this->hasMany(SubKategori::class, 'unit_id', 'id_unit');
    }

    public function laporans()
    {
        return $this->belongsToMany(Laporan::class, 'laporan_unit', 'unit_id', 'laporan_id');
    }
}
