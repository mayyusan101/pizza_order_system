@extends('admin.layouts.master')

@section('title','Change Password')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row offset-5">
                @if (session('changeSuccess'))
                <div class="alert alert-success alert-dismissible fade show col-10" role="alert">
                    <strong> {{ session('changeSuccess') }} !</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (session('notMatch'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> {{ session('notMatch') }} !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        <hr>
                        @error('terms')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{ route('adminAccount@changePassword') }}" method="post" novalidate="novalidate">
                            @csrf

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="text" value="{{ old('oldPassword') }}" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your old password..">
                                @error('oldPassword')
                                    <div class="invalid-feedback" >
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="text" value="{{ old('newPassword') }}" class="form-control  @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your new password..">
                                @error('newPassword')
                                    <div class="invalid-feedback" >
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="text" value="{{ old('confirmPassword') }}" class="form-control  @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your confirm password..">
                                @error('confirmPassword')
                                    <div class="invalid-feedback" >
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    <i class="fa-solid fa-key"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection