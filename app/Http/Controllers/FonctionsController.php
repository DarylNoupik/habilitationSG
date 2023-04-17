<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Fonctions;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FonctionsController extends Controller
{
    public function index (){
        $applications = application::all();
       
        //$fonctions = Fonctions::with('service.departement.direction','applications')->paginate(10);
        $fonctions = Fonctions::withCount('applications')
                    ->with('service.departement.direction')
                    ->paginate(10);
        $services = Service::all(); 
        return view('profiles.index',compact([
             'fonctions',
             'services'
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
        $fonction = Fonctions::find($id);
        $appPerFonc = $fonction->applications()->paginate(5);
        $applications = application::all();
        return view('profiles.applications',compact(['fonction','applications','appPerFonc']));
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
