<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturService extends Model
{
    use HasFactory;

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
