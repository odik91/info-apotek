<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MedichineSubclass extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function classMedichine()
    {
        return $this->hasOne(MedichineClass::class, 'id', 'kelas_id');
    }
}
