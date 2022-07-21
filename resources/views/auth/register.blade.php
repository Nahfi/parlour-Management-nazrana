@extends('layouts.frontend.auth.frontend_auth_app')
@section('frontend_auth_content')
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Welcome Back User !</h5>
            <p class="text-muted mt-2">Sign in to continue to Dason.</p>
        </div>
        <form class="mt-4 pt-2" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-username">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-username" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                       
                        {{-- <div class="form-floating-icon">
                          
                            <i class="fas fa-user"></i>
                           
                        </div> --}}
                    </div> 
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="input-email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
        
                       
                        {{-- <div class="form-floating-icon">
                            <i class="fas fa-envelope"></i>
                        </div> --}}
                    </div>
            
               </div>
               
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2 auth-pass-inputgroup">
                        <label for="input-password">Password</label>
                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" id="password-input" name="password" placeholder="Enter Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        {{-- <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                        </button>
                      
                        <div class="form-floating-icon">
                            <i class="fas fa-lock"></i>
                        </div> --}}
                    </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2 auth-pass-inputgroup">
                        <label for="input-password">Confirm Password</label>
                        <input type="password" class="form-control pe-5" id="password-input" name="password_confirmation" placeholder="Confrim Password">
{{--                     
                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                        </button> --}}
                       
                        {{-- <div class="form-floating-icon">
                            <i class="fas fa-lock"></i>
                        </div> --}}
                    </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="input-phone" name="phone" placeholder="Enter Phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                     
                        {{-- <div class="form-floating-icon">
                            <i class=" fas fa-mobile"></i>
                        </div> --}}
                    </div> 
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-bkash-phone">Bkash Phone</label>
                        <input type="text" class="form-control @error('bkash_phone') is-invalid @enderror" id="input-bkash-phone" name="bkash_phone" placeholder="Enter Bkash Phone" value="{{ old('bkash_phone') }}">
                        @error('bkash_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                       
                        {{-- <div class="form-floating-icon">
                            <i class=" fas fa-mobile"></i>
                        </div> --}}
                    </div> 
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-nid">Nid/Passport/B.Cirty</label>
                        <input type="text" class="form-control @error('nid') is-invalid @enderror" id="input-nid" name="nid" placeholder="Enter Nid" value="{{ old('nid') }}">
                        @error('nid')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
{{--                       
                        <div class="form-floating-icon">
                            <i class="fas fa-address-card"></i>
                        </div> --}}
                    </div> 
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-nid">Shop Name</label>
                        <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="input-nid" name="shop_name" placeholder="Enter Shop Name" value="{{ old('shop_name') }}">
                        @error('shop_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      
                        {{-- <div class="form-floating-icon">
                            <i class="fas fa-book-reader"></i>
                        </div> --}}
                    </div> 
                </div>
              
               <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                   <div class="form-group">
                       <label for="">Select Division</label>
                       <select class="form-control @error('division') is-invalid @enderror   mb-2" name="division" data-trigger 
                            id="choices-single-default">
                            <option value="">select divison</option>
                            @foreach ($data['divisions'] as $division )
                                <option {{ (old("division") == $division->id ? "selected":"") }} value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        @error('division')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                   </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                   <div class="form-group">
                       <label for="">District</label>
                       <select class="form-control @error('district') is-invalid @enderror mb-2" name="district" data-trigger 
                            id="choices-single-default">
                            <option value="">select disctrict </option>
                            @foreach ($data['districts'] as $district )
                                <option {{ (old("district") == $district->id ? "selected":"") }} value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                           
                          
                        </select>
                        @error('district')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                   </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                   <div class="form-group">
                    <label for="">Thana</label>
                       <select class="form-control @error('thana') is-invalid @enderror mb-2" name="thana" data-trigger 
                            id="choices-single-default">
                            <option value="">select thana</option>
                            @foreach ($data['thanas'] as $thana)
                                <option {{ (old("thana") == $thana->id ? "selected":"") }}  value="{{ $thana->id }}">{{ $thana->name }}</option>
                            @endforeach
                        </select>
                        @error('thana')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                   </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-2">
                        <label for="input-address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="input-address" name="address" placeholder="Enter Address" cols="30" rows="1">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      
                        {{-- <div class="form-floating-icon">
                            <i class="fas fa-address-book"></i>
                        </div> --}}
                    </div> 
                </div>
               
            </div>
        
            

            <div class="mb-3 text-center">
                <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Do you remember your account ? <a href="{{ route('login') }}"
                    class="text-primary fw-semibold"> Login </a> </p>
        </div>
        

    
    </div>
@endsection