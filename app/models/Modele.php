<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $fillable = ['modele_id','version','description','marque_id', 'nom_modele'];
}
