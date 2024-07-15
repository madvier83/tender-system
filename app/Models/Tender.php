<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'tgl_buka' => 'date',
        'tgl_tutup' => 'date',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class)->withTrashed();
    }

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class);
    }
}
