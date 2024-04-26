<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $factures = Commande::with(['fournisseurs','depot_voitures'])->get();
    return $factures;    
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commande= new Commande([
            'datecreation' => $request->input('datecreation'),
            'NomFournisseur'=>$request->input('NomFournisseur'),
            'Nom' => $request->input('Nom'),

            ]);
            $commande->save();
            
            return response()->json('commande créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commande= Commande::find($id);
return response()->json($commande);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
    $commande = Commande::find($id);
    $commande->update($request->all());
    return response()->json($commande);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $commande = Commande::find($id);
    

    $commande->delete();
    return response()->json(['message' => 'commande deleted successfully']);
    }
    public function showCommandeByDepot($iddep)
    {
        $Facture = Commande::where('Nom', $iddep)->with('depot_voitures')->get();
        return response()->json($Facture);
    }
    public function showCommandeByFournisseur($idfour)
    {
        $Facture = Commande::where('NomFournisseur', $idfour)->with('fournisseurs')->get();
        return response()->json($Facture);
    }
    }

