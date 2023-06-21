<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sk_bebas_temuan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'no_surat',
        'id_pemohon',
        'pemohon',
        'tujuan',
        'status',
        'file_name'
    ];
}
