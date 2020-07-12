<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Automobile extends Model
{
    protected $fillable = ['id', 'annee_sortie','estVendu', 'date_vente', 'prix','priorite','couleur_id','marque_id'];
}
