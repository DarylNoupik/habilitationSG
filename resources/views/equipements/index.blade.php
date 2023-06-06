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
                                        <h5 class="mb-0">Equipements </h5>
                                    </div>
                                    <a href="#" class="btn bg-gradient-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">+&nbsp; Nouvel équipement</a>
                                                <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Nouvel équipement</h5>
                                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ route('equipements.store')}}">
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
                                                                            <label for="pole_id" class="form-label"> pole d'appartenance :</label>
                                                                            <select class="form-select" id="pole_id" name="pole_id" required>
                                                                                <option selected disabled>Choisir un pole</option>
                                                                                @foreach ($poles as $pole)
                                                                                    <option value="{{ $pole->id }}">{{ $pole->nom }}</option>
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
                                       
                                       
                                    </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                @foreach ($poles as $pole)
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">{{$pole->nom}}</p>
                                        <h5 class="font-weight-bolder mb-0">
                                             {{ \App\Models\Equipement::where('pole_id', $pole->id)->count() }} 
                                            <!-- <span class="text-success text-sm font-weight-bolder">+55%</span>-->
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $poles->links() }}
            </div>
        </div>
        

        <div class="container-fluid py-4">
            <div class="row">
                @foreach ($poles as $pole)
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Pole : {{$pole->nom}}</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Equipement</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                            <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">Utilisateurs</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipPerPole[$pole->id] as $equipement)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                    </div>
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{$equipement->nom}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$equipement->description}}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                               <!-- 
                                                <span class="text-xs font-weight-bold"></span>
                                                -->
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="me-2 text-xs font-weight-bold">{{$equipement->users()->count()}} <i  class="cursor-pointer fas fa-user text-secondary" > </i>   soit {{round(($equipement->users()->count()/$users->count())*100,2)}}%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{round(($equipement->users()->count()/$users->count())*100,2)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($equipement->users()->count()/$users->count())*100,2)}}%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{route('equipements.users',$equipement->id)}}"><i  class="cursor-pointer fas fa-users text-secondary" > </i> </a>
                                                <span>
                                                  <i class="cursor-pointer fas fa-trash text-secondary"   data-bs-toggle="modal" data-bs-target="#deleteModal-{{$equipement->id}}"></i>
                                              </span>
                                              <div class="modal fade" id="deleteModal-{{$equipement->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$equipement->id}}" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="deleteModalLabel-{{$equipement->id}}">Supprimer l'élément</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                          Êtes-vous sûr de vouloir supprimer cet élément  {{$equipement->id}} ?
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                          <form method="post" action="{{ route('equipements.destroy', $equipement->id) }}">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" class="btn btn-danger">Supprimer</button>
                                                          </form>
                                                      </div>
                                                      </div>
                                                  </div>
                                                  </div>
                        
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-link text-secondary mb-0">
                                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{$equipPerPole[$pole->id]->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
</main>
@endsection