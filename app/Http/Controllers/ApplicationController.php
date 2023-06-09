<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**public function index (){
        $applications = Application::WithCount('users')
                        ->paginate(4);
        return view ('applications.index',compact('applications'));
    }**/
    public function index(Request $request)
{
    $query = $request->input('q');

    $applications = Application::query();

    // Si une recherche est effectuée, filtrer les résultats en conséquence
    if ($query) {
        $applications->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%");
        });
    }

    $applications = $applications->withCount('users','actions')
                                 ->paginate(4);
  

    return view('applications.index', compact('applications', 'query'));
}

    public function  create (){
        return view('applications.form');
    }
    public function store (Request $request){
        $application = new Application();
        $application->name = $request->input('nom');
        $application->description = $request->input('description');
        $application->save();
        return  redirect()->back()->with('success', 'La fonction a été ajoutée avec succès.');

    }

    public function show ($id){
        $application = Application::find($id);
        $actions = $application->actions()->paginate(4);
        $users = $application->users()->paginate(5);
        return view('applications.show',compact(['application','actions','users']));
    }

    public function edit ($id){
        $application = Application::find($id);
        return view('applications.edit',compact('application'));
    }

    public function update (Request $request, $id){
        $application = Application::find($id);
        $application->name = $request->input('nom');
        $application->description = $request->input('description');
        $application->save();
        return redirect()->route('applications.index');
    }
    public function destroy ($id){
        $application = Application::find($id);
        $application->delete();
        return redirect()->route('applications.index');
    }

}
