<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_apotek',
        'email',
        'password',
        'no_izin',
        'penanggung_jawab',
        'alamat',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',
        'no_telepon',
        'longlat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProvince()
    {
        return $this->hasOne(Province::class, 'id', 'provinsi_id');
    }

    public function userCity()
    {
        return $this->hasOne(City::class, 'id', 'kabupaten_id');
    }

    public function userDistrict()
    {
        return $this->hasOne(District::class, 'id', 'kecamatan_id');
    }
}
