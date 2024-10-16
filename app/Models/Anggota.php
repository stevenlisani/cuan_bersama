<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    public $table = "table_anggota";
    public $timestamps = false;
    protected $primaryKey = "id_anggota";

    protected $fillable = [
        'id_user', 'nama_lengkap', 'email', 'no_tlp', 'alamat'
    ];
}
