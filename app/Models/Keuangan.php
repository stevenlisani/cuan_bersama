<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    public $table = "table_keuangan";
    public $timestamps = false;
    protected $primaryKey = "id_keuangan";

    protected $fillable = [
        'id_anggota', 'tanggal', 'jumlah', 'status', 'foto'
    ];
}
