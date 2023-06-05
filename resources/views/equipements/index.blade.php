@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                    <div class="col-12">
                        <div class="card mb-4 mx-4">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h5 class="mb-0">Actions disponibles par applications</h5>
                                    </div>
                                    <a href="#" class="btn bg-gradient-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">+&nbsp; Nouvelle action</a>
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Nouvelle action</h5>
                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('actions.store') }}">
                                                    @csrf
                                                        <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nom" class="form-label">Nom :</label>
                                                            <input type="text" class="form-control" id="nom" name="nom" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description :</label>
                                                            <input type="text" class="form-control" id="description" name="description" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="application_id" class="form-label"> Application :</label>
                                                            <select class="form-select" id="application_id" name="application_id" required>
                                                                <option selected disabled>Choisir une application</option>
                                                                @foreach ($applications as $application)
                                                                    <option value="{{ $application->id }}">{{ $application->name }}</option>
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
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Application
                                                        </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Droits
                                                        </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Description
                                                        </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    @foreach ($actions as $action)
                                
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{$action->application->name}}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{$action->nom}}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{$action->description}}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            
                                                            <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile">
                                                                <i class="fas fa-edit text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$action->id}}" ></i>
                                                            </a>
                                                            <!-- Modal edit -->
                                                                <div class="modal fade" id="exampleModal-{{$action->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$action->id}}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                            <h5 class="modal-title" id="exampleModalLabel-{{$action->id}}">Action de {{$action->nom}}</h5>
                                                                                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                            </button>
                                                                                                        </div>
                                                                                        <form method="POST" action="{{ route('actions.update',$action->id) }}">
                                                                                                @csrf
                                                                                                        <div class="modal-body">
                                                                                                            <div class="mb-3">
                                                                                                                <label for="nom" class="form-label">Nom :</label>
                                                                                                                <input type="text" class="form-control" id="nom" name="nom" value="{{$action->nom}}"  required>
                                                                                                            </div>
                                                                                                            <div class="mb-3">
                                                                                                                <label for="description" class="form-label">Description :</label>
                                                                                                                <input type="text" class="form-control" id="description" name="description" value="{{$action->description}}"  required>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                                                            <button type="submit" class="btn bg-gradient-primary">Mettre à jour</button>
                                                                                                        </div>
                                                                                        </form>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    </div>
                                                                    
                                                            <!--end modal-->


                                                            <!-- Button trigger modal -->
                                                            <span>
                                                                <i class="cursor-pointer fas fa-trash text-secondary"   data-bs-toggle="modal" data-bs-target="#deleteModal-{{$action->id}}"></i>
                                                            </span>
                                                            <div class="modal fade" id="deleteModal-{{$action->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$action->id}}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="deleteModalLabel-{{$action->id}}">Supprimer l'élément</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Êtes-vous sûr de vouloir supprimer cet élément  {{$action->id}} ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                                <form method="GET" action="{{ route('actions.destroy', $action->id) }}">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                                </form>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            
                                            </table>
                                        </div>
                                    </div>
                            {{ $actions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection