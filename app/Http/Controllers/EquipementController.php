<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index (){
        $equipements = Equipement::all();
        return view('equipements.index',compact('equipements'));
    }

    public function  create (){
        return view('equipements.create');
    }

    public function store (Request $request){
        $equipement = new Equipement();
        $equipement->nom = $request->input('nom ');
        $equipement->save();
        return redirect()->route('equipements.index');

    }

    public function edit (){
        $equipement = Equipement::find($id);
        return view('equipements.edit',compact('equipement'));
    }
    public function update (Request $request, $id){
        $equipement = Equipement::find($id);
        $equipement->nom = $request->input('nom ');
        $equipement->save();
        return redirect()->route('equipements.index');
    }
    public function destroy ($id){
        $equipement = Equipement::find($id);
        $equipement->delete();
        return redirect()->route('equipements.index');
    }
}
