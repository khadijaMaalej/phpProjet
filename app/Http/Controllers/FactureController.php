<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::with(['articles', 'depot_voitures'])->get();
        return $factures;
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
     {
         try {
             $facture = new Facture([
                 'Total' => $request->input('Total'),
                 'Remise' => $request->input('Remise'),
                 'TotalTTC' => $request->input('TotalTTC'),
                 'Immatriculation' => $request->input('Immatriculation'),
                 'Nom' => $request->input('Nom'),
                 'DateCreation' => $request->input('DateCreation'),
             ]);
     
             $facture->save();
     
             return response()->json($facture, 201);
         } catch (\Exception $e) {
             return response()->json(['error' => $e->getMessage()], 500);
         }
     }
     

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $factures = Facture::find($id);
        return response()->json($factures);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $facture = Facture::find($id);
        $facture->update($request->all());
        return response()->json($facture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $facture = Facture::find($id);
        $facture->delete();
        return response()->json('Facture supprimé');
    }
    public function showFactureByArticle($idfact)
    {
        $Facture = Facture::where('Immatriculation', $idfact)->with('articles')->get();
        return response()->json($Facture);
    }

    public function showFactureByDepot($iddep)
    {
        $Facture = Facture::where('Nom', $iddep)->with('depot_voitures')->get();
        return response()->json($Facture);
    }
}
