<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=['NomFournisseur','datecreation','Nom'];

    public function fournisseurs()
    {
        return $this->belongsTo(Fournisseur::class,"NomFournisseur");
    }
    public function depot_voitures()
    {
        return $this->belongsTo(Depot_Voiture::class,"Nom");
    }

}
