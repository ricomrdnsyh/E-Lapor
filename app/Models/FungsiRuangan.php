<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FungsiRuangan extends Model
{
    protected $table = 'fungsi_ruangan';

    protected $primaryKey = 'id_fungsi';

    protected $fillable = [
        'nama_fungsi',
    ];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'jenis_ruangan', 'id_fungsi');
    }
}
