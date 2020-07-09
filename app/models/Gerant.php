<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Gerant extends Model
{
    protected $fillable = ['gerant_id','login', 'nom', 'prenom', 'password'];
}
