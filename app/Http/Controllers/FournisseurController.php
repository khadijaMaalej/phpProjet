<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all()->toArray();
return array_reverse($fournisseurs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fournisseur = new Fournisseur([
           
            'NomFournisseur' => $request->input('NomFournisseur'),
            'Adresse' => $request->input('Adresse'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone')
            ]);
            $fournisseur->save();
            return response()->json('Fournisseur créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $fournisseur= Fournisseur::find($id);
    return response()->json($fournisseur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
    $fournisseur = Fournisseur::find($id);
    $fournisseur->update($request->all());
    return response()->json($fournisseur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $fournisseur = Fournisseur::find($id);
    $fournisseur->delete();
    return response()->json(['message' => 'Auteur deleted successfully']);
    }
}
