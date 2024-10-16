<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    use HasFactory;

    public $table = "table_investasi";
    public $timestamps = false;
    protected $primaryKey = "id_investasi";

    protected $fillable = [
        'coin', 'harga_entri', 'nominal', 'profit', 'created_at', 'status'
    ];
}
