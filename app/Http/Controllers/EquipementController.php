<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Pole;
use App\Models\User;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index (Request $request){
        $poles = Pole::paginate(6);
        $users = User::all();
        $query = $request->input('q');
        $equipements = Equipement::query();
        if ($query) {
            $equipements->where(function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%$query%");
            });
        }
        $equipements = $equipements->with('pole')
                                   ->paginate(5);

        $equipPerPole =[];

        foreach($poles as $pole){
            $equipPerPole[$pole->id] = Equipement::where('pole_id',$pole->id)->paginate(5);
        }
        //dd($equipPerPole);
    

        return view('equipements.index',compact(['equipements','poles','query','equipPerPole','users']));
    }

    public function  create (){
        return view('equipements.create');
    }

    public function store (Request $request){
        $equipement = new Equipement();
        $equipement->nom = $request->input('nom');
        $equipement->description =$request->input('description');
        $equipement->pole_id = $request->input('pole_id');
        $equipement->save();
        return redirect()->route('equipements.index');

    }

    public function edit ($id){
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
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();
        return redirect()->route('equipements.index');
    }

    public function getUsers($id){
        $equipement = Equipement::findOrfail($id);
        $users = User::all();
        $responsables = $equipement->users ;
        return view('equipements.users',compact(['equipement','users','responsables']));
    }
    public function storeUser (Request $request , $equipement){
        $userId = $request->input('user_id');
        $user = User::findOrfail($userId);
        $equipement = Equipement::findOrFail($equipement);
        $equipement->users()->attach($user);
        return redirect()->back()->with('success', 'Responsable ajouté avec succès');
    }
    public function removeUser($equipementId,$userId){
        $equipement = Equipement::findOrFail($equipementId);
        $user = User::findOrfail($userId);
        $equipement->removeUser($user);
        return redirect()->back()->with('success', 'Responsable retiré avec succès');

    }
}
