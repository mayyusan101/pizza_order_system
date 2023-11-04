@extends('admin.layouts.master')

@section('title','Information Edit')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="#">
                                <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark" onclick="history.back()"></i></div>
                            </a>
                            <h3 class="text-center title-2">Edit Your Information</h3>
                        </div>
                        <hr>
                        <form action="{{ route('Admin@updateDetail') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image != null)
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt=""  class="img-thumbnail shadow-sm">
                                    @elseif(Auth::user()->gender == 'male')
                                        <img src="{{ asset('images/admin.png') }}" alt=""  class="img-thumbnail shadow-sm">
                                    @elseif(Auth::user()->gender == 'female')
                                        <img src="{{ asset('images/admin-female.png') }}" alt=""  class="img-thumbnail shadow-sm">
                                    @else
                                        <img src="{{ asset('images/other.jpg') }}" class="img-thumbnail shadow-sm ">
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

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role"   value="{{ Auth::user()->role }}"  disabled class="form-control" placeholder="Enter your phone..">
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
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
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