<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Models\Fonctions;
use App\Models\application ;


class UserController extends Controller
{


    public function getUsers(Request $request){
        $query = $request->input('q');
        $users = User::query();
        //$users = User::withCount('applications')
          //             ->with(['fonction.service'])->paginate(7);
            

           

            


        $fonctions = Fonctions::all();
  
        // Recherche par nom d'utilisateur
        if ($query) {
            $users->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('matricule','LIKE','%'.$query.'%');
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

        $users = $users->withCount('applications')
                     ->with(['fonction.service'])->paginate(7)->appends($request->except('page'));

        return view('users.index', compact(['users','fonctions','query']));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function destroy ($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
    public function update (Request $request, $id){
        
        $user = User::find($id);
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->matricule = $request->input('matricule');
        $user->role = $request->input('role');
        $user->fonction_id = $request->input('fonction_id');
        $user->save();
        return redirect()->route('users.index');
    }

    public function edit ($id){
        $user = User::find($id);
        return view('applications.edit',compact('user'));
    }
    public function show ($id){
    
        $user = User::with(['fonction.service'])->find($id);
        $appPerUser = $user->applications()->paginate(3);
        $applications = application::all();

        return view('users.show',compact(['user','appPerUser','applications']));
    }
    public function store (Request $request){
        
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

    public function Count_applicationPerUser($id) {
        $user = User::find($id);
        $applications = $user->applications;
        $count = count($applications);
        return $count;
    }
  
}
