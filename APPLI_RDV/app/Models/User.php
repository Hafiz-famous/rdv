<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ✅ Autoriser l'assignation de masse pour ces colonnes
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        // ajoute si tu enregistres ces champs au même endroit :
        // 'phone', 'dob', 'address', 'insurance'
    ];

    // Masquer au JSON
    protected $hidden = ['password','remember_token'];

    // Casts utiles
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
