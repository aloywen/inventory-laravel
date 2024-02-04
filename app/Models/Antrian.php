<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'nomor_antrian',
        'nomor_loket',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
