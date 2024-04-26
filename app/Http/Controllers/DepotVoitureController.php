<?php

namespace App\Http\Controllers;

use App\Models\Depot_Voiture;
use Illuminate\Http\Request;

class DepotVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depots = Depot_Voiture::all()->toArray();
return array_reverse($depots);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $depot = new Depot_Voiture([
           
            'id' => $request->input('id'),
            'Nom' => $request->input('Nom'),
            'Marque' => $request->input('Marque'),
            'Voiturecompatible' => $request->input('Voiturecompatible'),
            'Quantite' => $request->input('Quantite'),
            'Prix' => $request->input('Prix')
        ]);
           
        
            $depot->save();
            return response()->json('Voiture créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $depot = Depot_Voiture::find($id); 
        return response()->json($depot); 
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $depot = Depot_Voiture::find($id);
        $depot->update($request->all());
        return response()->json($depot);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $depot=Depot_Voiture::find($id);
        $depot->delete();
        return response()->json(['message' => 'article deleted successfuly']);
    }
}
