
@extends('layouts.user_type.auth')
@section('css')

@endsection

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Applications</h5>
                        </div>  
                    <!-- Button trigger modal -->
                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0 " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" >+&nbsp; Nouvelle application</a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelle application</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('applications.store') }}" >
                                @csrf
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description :</label>
                                        <textarea class="form-control" id="description" name="description" required></textarea>
                                    </div>
                                    </div>
                                   
                              
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
                <div class="card-body px-4 pt-4 pb-2 ">
                </div>
            </div>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-4 g-2">  
    @foreach ($applications as $application)
    <div class="col"> 
        <div class="card text-bg-primary mb-3 " style="max-width: 18rem;">
            <div class="card-header text-center border-bottom">
                 <h5>{{$application->name}}</h5>
            </div>
             <div class= "row">
                <div class="col-md-4 d-flex justify-content-center border-end">
                    <img src="./assets/img/small-logos/logo-jira.svg" class="img-fluid rounded-start  " alt="...">
                </div>
                <div class="col-md-8 ">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <span class="d-inline-block bg-success rounded-circle p-1"></span> 0 <i class="fas fa-user text-secondary"></i></li>
                        <li class="list-group-item"> <span class="d-inline-block bg-success rounded-circle p-1"> </span> 0 <i class="fas fa-tools text-secondary"></i> </li>
                        </ul>   
                    </div>
                </div>
             </div>
             <div class="card-footer border-top row row-cols-1 row-cols-md-3 g-1 "> 
                <div class="col">
                    <a href="#" class="btn btn-danger">
                        <i class="fas fa-eye text-white"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-danger">
                        <i class="fas fa-edit text-white"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-danger">
                        <i class="fas fa-trash-alt text-white"></i>
                    </a>
                </div>
             </div>
        </div>
    </div>
    @endforeach         

                                   

                                    
 </div>

 <div>
{{$applications->links()}} 
</div>
        

@endsection

