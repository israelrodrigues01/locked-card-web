<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'REGISTROS';
    protected $primaryKey = 'CODREGIS';

    protected $fillable = [
        'CODUSU',
        'ENTRADA',
        'SAIDA',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'CODUSU', 'CODUSU');
    }
}
