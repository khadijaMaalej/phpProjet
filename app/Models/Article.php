<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'Immatriculation','Nchassis','Marque','Modele','Moteur','imageart'
        ];
        public function factures()
        {
            return $this->hasMany(Facture::class,"Immatriculation");
        }
}
