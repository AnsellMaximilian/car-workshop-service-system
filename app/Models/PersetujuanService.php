<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanService extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';
    public $incrementing = false;
}
