<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    public function markAsChecked()
    {
        if(!$this->dicek){
            $this->dicek = true;
            $this->save();
        }
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
