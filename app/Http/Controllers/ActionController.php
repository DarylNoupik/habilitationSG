<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\application;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index (){

        $applications = application::all();
        $query = request()->input('q');
        $actions= Action::query();
        if ($query) {
            $actions->where(function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%$query%");
            });
        }
        $actions = $actions->with('application')
                    ->orderBy('application_id','asc')
                    ->paginate(10);
        
        return view('actions.index',compact([
             'actions',
             'applications',
             'query'
        ]));
    }
    public function store() {
       
        $data = request()->validate([
            'nom' => 'required',
            'description' => 'required',
            'application_id' => 'required',
        ]);
        $actions = Action::create($data);
        return redirect()->route('actions.index')->with('success','Action ajoutée avec succès');
    }

    public function destroy ($id) {
        $action = Action::find($id);
        $action->delete();
        return redirect()->route('actions.index')->with('success','Action supprimée avec succès');
    }

    public function update($id) {
        $data = request()->validate([
            'nom' => 'required',
            'description' => 'required',
        ]);
        $action = Action::find($id);
        $action->update($data);
        return redirect()->route('actions.index')->with('success','Action modifiée avec succès');
    }
 
}
