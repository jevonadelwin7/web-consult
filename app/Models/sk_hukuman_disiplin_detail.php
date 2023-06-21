<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sk_hukuman_disiplin_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_permohonan',
        'id_pemohon',
        'sp_hukuman_disiplin',
        'sk_pangkat',
        'message'
    ];
}
