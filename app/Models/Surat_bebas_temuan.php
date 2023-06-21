<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_bebas_temuan extends Model
{
    use HasFactory;
    protected $fillable = [
    'id_permohonan_detail',
    'id_permohonan',
    'nomor_surat',
    'nama_pejabat',
    'nip_pejabat',
    'pang_gol_pejabat',
    'jabatan_pejabat',
    'nama_pemohon',
    'nip_pemohon',
    'pang_gol_pemohon',
    'jabatan_pemohon',
    'unit_kerja_pemohon',
    'tanggal_surat',
    'jabatan_ttd',
    'status',
    'tipe',
    ];
}
