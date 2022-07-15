<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MedicalEquipment extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function infoKelompokAlkes()
    {
        return $this->hasOne(MedicalDeviceGroup::class, 'id', 'kelompok_alkes_id');
    }

    public function infoKategoriAlkes()
    {
        return $this->hasOne(MedicalDeviceCategory::class, 'id', 'kategori_alkes_id');
    }

    public function infoKelasAlkes()
    {
        return $this->hasOne(MedicalDeviceClass::class, 'id', 'kelas_alkes_id');
    }

    public function infoKelasResiko()
    {
        return $this->hasOne(MedicalDeviceRiskClass::class, 'id', 'kelas_resiko_alkes_id');
    }

    public function infoSifatAlkes()
    {
        return $this->hasOne(MedicalDeviceProperties::class, 'id', 'sifat_alkes_id');
    }
}
