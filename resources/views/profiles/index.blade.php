@extends('layouts.user_type.auth')

@section('content')

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Profils métiers</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">+&nbsp; Nouvelle Fonction</a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouveau profil</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('fonctions.store') }}">
                                 @csrf
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="service_id" class="form-label">Service :</label>
                                        <select class="form-select" id="service_id" name="service_id" required>
                                            <option selected disabled>Choisir un service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->nom }}</option>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nom
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Service
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Departement
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Direction
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                       Applications
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach ($fonctions as $fonction)
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$fonction->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$fonction->nom}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$fonction->service->nom}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$fonction->service->departement->nom}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$fonction->service->departement->direction->nom}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $fonction->applications_count }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route( 'fonctions.show', $fonction->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"   data-bs-toggle="modal" data-bs-target="#deleteModal-{{$fonction->id}}"></i>
                                        </span>
                                        <div class="modal fade" id="deleteModal-{{$fonction->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$fonction->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{$fonction->id}}">Supprimer l'élément</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet élément  {{$fonction->id}} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form method="GET" action="{{ route('fonctions.destroy', $fonction->id) }}">
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
                {{ $fonctions->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="../assets/js/plugins/datatables.js"></script>
@endpush