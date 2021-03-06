<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MedicalEquipmentStock extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function namaAlkes()
    {
        return $this->hasOne(MedicalEquipment::class, 'id', 'alkes_id');
    }
}
