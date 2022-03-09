<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_peran';
    public $incrementing = false;
    protected $keyType = 'string';
}
