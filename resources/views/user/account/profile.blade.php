@extends('user.layouts.master')

@section('title','My Profile')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="container">
                <div class="col-5 offset-7">
                    @if (session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-10" role="alert">
                            <strong> {{ session('updateSuccess') }} !</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('user#home') }}">
                                <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark"></i></div>
                            </a>
                            <h3 class="text-center title-2">Edit Your  Information</h3>
                        </div>
                        <hr>
                        <form action="{{ route('User@profileChange') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image != null)
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm "  >
                                    @elseif(Auth::user()->gender == 'male')
                                        <img src="{{ asset('images/user.jpg') }}" class="img-thumbnail shadow-sm "  >
                                    @elseif(Auth::user()->gender == 'female')
                                        <img src="{{ asset('images/user-female.png') }}"  class="img-thumbnail shadow-sm " >
                                    @else
                                        <img src="{{ asset('images/user-other.png') }}"  class="img-thumbnail shadow-sm " >                
                                    @endif 
                                    <div class="form-group mt-2">
                                        <label for="cc-payment" class="control-label mb-1">Choose image</label>
                                        <input id="cc-pament" name="image" type="file" value="" class="form-control  @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your image..">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ old('name' ,Auth::user()->name) }}" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your name..">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text" value="{{ old('email' ,Auth::user()->email) }}" class="form-control  @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your email..">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" value="{{ old('phone' ,Auth::user()->phone) }}" class="form-control  @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone..">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Choose gender</label>
                                        <select class="form-select form-select-sm form-control" name="gender" aria-label=".form-select-sm example">
                                            <option @if(Auth::user()->gender == 'male') selected @endif value="male" id="cc-pament">Male</option>
                                            <option @if(Auth::user()->gender == 'female') selected @endif value="female">Female</option>
                                            <option @if(Auth::user()->gender == 'other') selected @endif value="other">Other</option>
                                        </select>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control" id="cc-payment" cols="30" rows="3">{{ Auth::user()->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block  text-white">
                                            <span id="payment-button-amount">Update</span>        
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>


@endsection