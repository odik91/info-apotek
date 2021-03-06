<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'provinsi_id');
    }
}
