@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Bienvenue</h3>
                  
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Email ou matricule</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" name="login" id="login" placeholder="Email" value="test@test.gmail" aria-label="Email" aria-describedby="login-addon">
                      @error('login')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="12345" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Connectez-vous</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Mot de passe oublié ? Reinitialiser le mot de passe
                  <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">ici</a>
                </small>
                  <p class="mb-4 text-sm mx-auto">
                    Vous n'avez pas de compte ? 
                    <a href="register" class="text-info text-gradient font-weight-bold">Enregistrez vous</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved10.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
