<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Properti $fillable untuk memasukkan data secara massal
    protected $fillable = [
        'name',           // Nama pengguna
        'email',          // Email pengguna
        'password',       // Password pengguna
        'phone',          // Nomor HP pengguna
        'nomor_ktp',      // Nomor KTP pengguna
        'birth_date',     // Tanggal lahir pengguna
        'gender',         // Jenis kelamin pengguna
        'address',        // Alamat pengguna
    ];

    // Properti $hidden untuk menyembunyikan atribut sensitif
    protected $hidden = [
        'password',       // Menyembunyikan password
        'remember_token', // Menyembunyikan token untuk "remember me"
    ];

    // Properti $casts untuk casting atribut ke tipe data tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    /**
     * Send password reset notification dengan custom notification
     * Method ini WAJIB ada untuk fitur lupa password
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // Optional: Accessor untuk format nama
    public function getFormattedNameAttribute()
    {
        return ucwords(strtolower($this->name));
    }

    // Optional: Accessor untuk umur berdasarkan tanggal lahir
    public function getAgeAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->age;
        }
        return null;
    }

    // Optional: Scope untuk filter berdasarkan gender
    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }
}