<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Medichine extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function getKelas()
    {
        return $this->hasOne(MedichineClass::class, 'id', 'kelas_obat_id');
    }

    public function getSubkelas()
    {
        return $this->hasOne(MedichineSubclass::class, 'id', 'subkelas_obat_id');
    }

    public function getSediaanObat()
    {
        return $this->hasOne(MedichinePreparation::class, 'id', 'sediaan_obat_id');
    }
}
