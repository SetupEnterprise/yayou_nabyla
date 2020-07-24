<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'photo_id', 'automobile_id', 'nom_photo'];

}
