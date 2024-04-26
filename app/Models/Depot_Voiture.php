<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot_Voiture extends Model
{
    use HasFactory;
    

    protected $fillable=['Nom','Marque','Voiturecompatible','Quantite','Prix'];
    public function factures()
    {
        return $this->hasMany(Facture::class,"Nom");
    }
}
