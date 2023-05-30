<?php

namespace App\Http\Controllers;


use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Models\Fonctions;
use App\Models\application;


class UserController extends Controller
{


    public function getUsers(Request $request)
    {
        //dd(request()->path());
        $query = $request->input('q');
        $users = User::query();
        //$users = User::withCount('applications')
        //             ->with(['fonction.service'])->paginate(7);


        $fonctions = Fonctions::all();

        // Recherche par nom d'utilisateur
        if ($query) {
            $users->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('matricule', 'LIKE', '%' . $query . '%');
        }

        // Recherche par adresse e-mail
        if ($request->has('email')) {
            $users->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        // Tri par colonne
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
            $sort_dir = $request->input('sort_dir', 'asc');

            $users->orderBy($sort_by, $sort_dir);
        }
        if(request()->path()==="users/suspended"){
            $users= $users->onlyTrashed()->withCount('applications')
            ->with(['fonction.service'])->paginate(7)->appends($request->except('page'));
        }else{
        $users = $users->withCount('applications')
            ->with(['fonction.service'])->paginate(7)->appends($request->except('page'));
        }

        return view('users.index', compact(['users', 'fonctions', 'query']));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->matricule = $request->input('matricule');
        $user->role = $request->input('role');
        $user->fonction_id = $request->input('fonction_id');
        $user->save();
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('applications.edit', compact('user'));
    }

    public function show($id)
    {

        /**$user = User::find($id);


        $user = $user->load([
            'fonction' => function ($fonction) {
                $fonction->with('service');
            },
            'applications' => function ($applications) {
                $applications->select('id')->with(['actions' => function ($actions) use ($applications) {
                    $actions->whereHas('fonctions', function ($fonctions) use ($applications) {
                        $fonctions->whereIn('id', function ($query) use ($applications) {
                            $query->select('fonction_id')
                                ->from('fonction_actions')
                                ->where('action_id', $applications->select('id')->first()->id);
                        });
                    });
                }]);
            }
        ]);
        
        

        $applications = application::all();

        return view('users.show', compact(['user', 'appPerUser', 'applications']));**/

       /* $user = User::with(['fonction.service', 'applications.actions.fonctions'])->find($id);
        
        $applications = Application::all();
        return view('users.show', compact(['user', 'applications']));*/

       /* $user = User::find($id);
        $user->load('fonction.service');
        $user->applications->load('actions.fonctions');

        // Récupérer les applications de l'utilisateur avec les actions associées
        $aplications = $user->fonction->applications->map(function ($application) {
            $actions = $application->actions;
            $application->setAttribute('actions', $actions);
            return $application;
        });

       /*** foreach ($user->applications as $application ){
            foreach ($application->actions as $action){

                dd($action->fonction_id);
            }
        }***/
        
        /*$user = User::query()
        ->join('application_user', 'users.id', '=', 'application_user.user_id')
        ->join('actions', 'application_user.application_id', '=', 'actions.application_id')
        ->join('applications','applications.id','=','application_user.application_id')
        ->join('fonction_actions', 'actions.id', '=', 'fonction_actions.action_id')
        ->whereColumn('users.fonction_id', '=', 'fonction_actions.fonction_id')
        ->where('users.id', $id)
        ->first();*/
    /**foreach ($user2->applications as $application){
        dd($application->actions);
    }*/
    //  dd( $user2->applications);
      //  $applications = Application::all();

      $user = User::findOrFail($id);
      $applications = $user->applications()->paginate(4);
      $actions = [];
  
      foreach ($applications as $application) {
          $actions[$application->id] = $user->actions()->wherePivot('application_id', $application->id)->get();
         
      }
      
      
      return view('users.show', compact('user', 'applications', 'actions'));

    }

    public function store(Request $request)
    {

        $user = new User();

        $password = 'mon_mot_de_passe_par_defaut';
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->matricule = $request->input('matricule');
        $user->role = $request->input('role');
        $user->fonction_id = $request->input('fonction_id');
        $user->save();
        // Récupérer les applications de la fonction de l'utilisateur
        // $applications = $user->fonction->applications;

        // Attacher les applications à l'utilisateur
        //  $user->applications()->attach($applications);

        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été créé avec succès.');
    }

    public function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été restauré avec succès.');

    }

}
