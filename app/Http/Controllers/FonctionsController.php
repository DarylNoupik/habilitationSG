<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\application;
use App\Models\Fonctions;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FonctionsController extends Controller
{
    public function index (){
        $applications = application::all();
       
       
        $query = request()->input('q');
        $fonctions= Fonctions::query();
        if ($query) {
            $fonctions->where(function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%$query%");
            });
        }
        $fonctions = $fonctions->withCount('applications')
                    ->with('service.departement.direction')
                    ->paginate(10);
        $services = Service::all(); 
        return view('profiles.index',compact([
             'fonctions',
             'services',
             'query'
        ]));
    }

    public function  create (){
        return view('profiles.create');
    }

    public function store (Request $request){
        try {
                $validatedData = $request->validate([
                    'nom' =>  [
                        'required',
                        Rule::unique('fonctions')->where(function ($query) use ($request) {
                            return $query->where('service_id', $request->input('service_id'));
                        })
                    ],
                    'service_id' => 'required|exists:services,id',
                ]);
            
                Fonctions::create($validatedData);
            
                return redirect()->back()->with('success', 'La fonction a été ajoutée avec succès.');
            } catch (QueryException $e) {
                return redirect()->back()->with('error', 'Impossible d\'enregistrer la fonction. Vérifiez que le nom et l\'id du service n\'existent pas déjà.');
            }

    }

    public function storeApp (Request $request, $id){
        $fonction = Fonctions::find($id);
        $application = Application::find($request->input('application_id'));
        $fonction->addApplication($application);
        return redirect()->back()->with('success', 'L\'application a été ajoutée avec succès.');
    }
    public function storeAction (Request $request, $id){
        $fonction = Fonctions::find($id);
        $action = Action::find($request->input('action_id'));
       // $application = application::find($request->input('application_id'));
        $fonction->addAction($action);
        //$fonction->users->addFonctionAction($action);
        return redirect()->back()->with('success', 'L\'action a été ajoutée avec succès.');
    }

    public function edit ($id){
        $fonction = Fonctions::find($id);
        return view('profiles.edit',compact('fonction'));
    }

    public function update (Request $request, $id){
        $fonction = Fonctions::find($id);
        $fonction->nom = $request->input('nom ');
        $fonction->id_service = $request->input('id_service');
        $fonction->save();
        return redirect()->route('profiles.index');
    }
    public function destroy ($id){
        $fonction = Fonctions::find($id);
        $fonction->delete();
        return redirect()->back()->with('success', 'La fonction a été supprimé avec succès.');
    }
    public function show ($id){
        $fonction = Fonctions::with('applications')->find($id);
        $appPerFonc = $fonction->applications()->paginate(4);
        $applications = application::all();
        return view('profiles.applications',compact(['fonction','applications','appPerFonc']));
    }
    public function showApp ($id,$id_ap){
          // Récupérer la fonction avec l'ID donné
    $fonction = Fonctions::findOrFail($id);

    // Récupérer l'application avec l'ID donné
    $application = Application::findOrFail($id_ap);

    // Récupérer les actions de l'application
    $actions = $application->actions()->paginate(4);
    // Récupérer les actions de la fonction
    $actionsPerFonc = $fonction->actions()->where('application_id', $id_ap)->paginate(4);
    
        return view('profiles.actions',compact(['fonction','application','actions','actionsPerFonc']));
    }

    public function search (Request $request){
        $fonctions = Fonctions::query();
        if ($request->has('nom')) {
            $fonctions->where('nom', 'LIKE', '%' . $request->input('nom') . '%');
        }
        if ($request->has('id_service')) {
            $fonctions->where('id_service', 'LIKE', '%' . $request->input('id_service') . '%');
        }
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
            $sort_dir = $request->input('sort_dir', 'asc');
            $fonctions->orderBy($sort_by, $sort_dir);
        }
        $fonctions = $fonctions->paginate(5)->appends($request->except('page'));
        return view('profiles.index', compact('fonctions'));
    }
}
