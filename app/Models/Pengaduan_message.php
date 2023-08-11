<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan_message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'UserID',
        'room_id',
        'nama_terlapor',
        'jabatan_pekerjaan',
        'alamat',
        'tempat_kejadian',
        'waktu_kejadian',
        'uraian',
        'aduan_file',
        'message',
        'message_file',
        'status'
    ];
}
