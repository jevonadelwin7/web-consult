<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult_room extends Model
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
