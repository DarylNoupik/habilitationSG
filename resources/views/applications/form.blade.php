@extends('layouts.user_type.auth')
@section('css')

@endsection

@section('content')

      <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card ">
            <div class="card-header text-center pt-4">
              <h5>C</h5>
            </div>
            <div class="card-body">
              <form role="form text-left">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                  @error('name')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="text-center">
                  <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>



@endsection