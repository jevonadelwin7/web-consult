<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'roomID',
        'file_name',
        'id_user',
        'id_admin',
        'status'
    ];
}
