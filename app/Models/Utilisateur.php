<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Model
{
    use HasApiTokens; // ← ajout

    protected $fillable = [
        'nom', 'age', 'lieu', 'tel', 'email',
        'profession', 'residence', 'password'
    ];

    protected $hidden = ['password']; // ne jamais renvoyer le password au frontend
}
