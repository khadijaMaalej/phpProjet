<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all()->toArray();
return array_reverse($articles);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = new Article([
            'Immatriculation' => $request->input('Immatriculation'),
            'Nchassis' => $request->input('Nchassis'),
            'Marque' => $request->input('Marque'),
            'Modele' => $request->input('Modele'),
            'Moteur' => $request->input('Moteur'),
            'imageart' => $request->input('imageart')
        ]);
           
        
            $article->save();
            return response()->json('article créé !');
    }

    /**
     * Display the specified resource.
     */
  
        public function show($id)
        {
            $article = Article::find($id); 
            return response()->json($article); 
            
        }

    public function update($id, Request $request)
    {
        $article = Article::find($id);
        $article->update($request->all());
        return response()->json($article);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $depot=Article::find($id);
        $depot->delete();
        return response()->json(['message' => 'article deleted successfuly']);
    }
}
