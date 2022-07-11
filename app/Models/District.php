<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class District extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [];

    public function cities()
    {
        return $this->hasOne(City::class, 'id', 'kabupaten_id');
    }
}
