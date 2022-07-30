<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MedichineStock extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function getMedichineName()
    {
        return $this->hasOne(Medichine::class, 'id', 'obat_id');
    }

    public function getApotek()
    {
        return $this->hasOne(User::class, 'id', 'apotek_id');
    }
}
