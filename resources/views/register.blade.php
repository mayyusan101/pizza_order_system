@extends('layouts.master')

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            @error('terms')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Username">
                @error('name')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email </label>
                <input class="au-input au-input--full" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="09xxxx">
                @error('phone')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <select class="form-select form-select-sm form-control" name="gender" class="form-control @error('gender') is-invalid @enderror" aria-label=".form-select-sm example">
                    <option selected>Choose gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="UserAddress">
                @error('address')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                @error('password_confirmation')
                    <small class="text-danger" >
                        {{ $message }}
                    </small>
                @enderror
            </div>
            
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
            
        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection