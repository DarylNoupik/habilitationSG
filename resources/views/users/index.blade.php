@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Utilisateurs</h5>
                            </div>
                            <a href="#" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">+&nbsp; Nouvel Utilisateur</a>
                            <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvel utilisateur </h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('users.store') }}">
                                 @csrf
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="matricule" class="form-label">Matricule :</label>
                                        <input type="text" class="form-control" id="matricule" name="matricule" placeholder="agxxxxx" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role :</label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option selected disabled>Choisir un role</option>
                                                <option value="admin">Administrateur</option> 
                                                <option value="rssi">Consultant</option>
                                                <option value="user">Utilisateur</option>
                                            
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fonction_id" class="form-label"> Fonction :</label>
                                        <select class="form-select" id="fonction_id" name="fonction_id" required>
                                            <option selected disabled>Choisir une fonction </option>
                                            @foreach ($fonctions as $fonction)
                                                <option value="{{ $fonction->id }}">{{ $fonction->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                </form>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn bg-gradient-primary">Créer</button>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
                     <!--end modal-->
                  </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur  </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fonction</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombres d'applications</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->matricule}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$user->fonction->nom}}</p>
                        <p class="text-xs text-secondary mb-0">{{ $user->fonction->service->nom }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">{{ $user->role }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$user->applications_count}}</span>
                      </td>
                      <td class="align-middle">
              <!-- bouton d'édition -->
                      <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                          <i class="fas fa-user-edit text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user->id}}"></i>
                      </a>
              <!-- Modal -->
                <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$user->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel-{{$user->id}}">Modification sur {{$user->name}} </h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                              <form action="{{ route('users.update', $user->id) }}" method="POST">
                                   @csrf
                                  
                                    <div class="modal-body">
                                             
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">Nom :</label>
                                                    <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email :</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="matricule" class="form-label">Matricule :</label>
                                                    <input type="text" class="form-control" id="matricule" name="matricule" placeholder="agxxxxx" value="{{$user->matricule}}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role :</label>
                                                    <select class="form-select" id="role" name="role" value="{{$user->role}}" required>
                                                        <option  value="{{$user->role}}">
                                                          @if ($user->role == 'admin')
                                                            Administrateur
                                                          @elseif ($user->role == 'rssi')
                                                            Consultant
                                                          @else
                                                            Utilisateur
                                                          @endif
                                                        </option>
                                                            <option value="admin">Administrateur</option> 
                                                            <option value="rssi">Consultant</option>
                                                            <option value="user">Utilisateur</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fonction_id" class="form-label"> Fonction :</label>
                                                    <select class="form-select" id="fonction_id" name="fonction_id" required>
                                                        <option  value="{{$user->fonction_id}}">{{$user->fonction->nom}} </option>
                                                        @foreach ($fonctions as $fonction)
                                                            <option value="{{ $fonction->id }}">{{ $fonction->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                                
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn bg-gradient-primary">Enregistrer</button>
                                        </div>
                              </form>
                                 
                        </div>  
                    </div>
                 </div>
              <!--end modal-->
              <!-- bouton de suppression -->
                      <span>
                          <i class="cursor-pointer fas fa-trash text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$user->id}}"></i>
                      </span>
              <!-- Modal de suppression -->
                      <div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$user->id}}" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{$user->id}}">Supprimer l'élément</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet élément  {{$user->id}} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form method="GET" action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                 </div>
                              </div>
                          </div>
              <!-- end modal de suppression -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
           
            </div>
            {{ $users->links() }}
          </div>
        </div>
      </div>
     
    </div>
  </main>
@endsection