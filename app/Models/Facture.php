<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable=['Total','Remise','TotalTTC','Immatriculation','Nom','DateCreation'];

    public function articles()
    {
        return $this->belongsTo(Article::class,"Immatriculation");
    }
    public function depot_voitures()
    {
        return $this->belongsTo(Depot_Voiture::class,"Nom");
    }

}
