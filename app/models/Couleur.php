<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    protected $fillable = ['couleur_id', 'nom', 'automobile_id'];
}
