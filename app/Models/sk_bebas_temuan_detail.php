<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sk_bebas_temuan_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_permohonan',
        'id_pemohon',
        'sk_pangkat',
        'sk_bebas_asset',
        'sk_bebas_utang',
        'sk_bebas_ikatan_dinas',
        'sp_hukuman_disiplin',
        'message',
        'is_upload'
    ];
}
