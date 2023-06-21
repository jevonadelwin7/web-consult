<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult_message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'UserID',
        'room_id',
        'message',
        'status'
    ];
}
