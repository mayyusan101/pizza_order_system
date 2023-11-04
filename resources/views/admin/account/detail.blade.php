@extends('admin.layouts.master')

@section('title','Admin Detail')

@section('content')
<div class="main-content">
    <div class="row mb-1 me-1">
        <div class="col-6 offset-5 ">
            @if(session('update'))
                <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                    <strong>  {{ session('update') }} </strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> 
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="card mx-5">
                <div class="card-body ">
                    <div class="card-title">
                        <a href="#">
                            <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark" onclick="history.back()"></i></div>
                        </a>
                        <h3 class="text-center title-2">Admin Detail</h3>
                    </div>
                    <hr> 
                    <div class="row ">
                        <div class="col-4 offset-2">
                            @if (Auth::user()->image != null)
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt=""  class="img-thumbnail shadow-sm">
                            @elseif(Auth::user()->gender == 'male')
                                <img src="{{ asset('images/admin.png') }}" alt=""  class="img-thumbnail shadow-sm">
                            @elseif(Auth::user()->gender == 'female')
                                <img src="{{ asset('images/admin-female.png') }}" alt=""  class="img-thumbnail shadow-sm">
                            @else
                                <img src="{{ asset('images/other.jpg') }}" class="img-thumbnail shadow-sm ">
                            @endif 
                        </div>
                        <div class="col-6 mt-4 ">
                            <h4 class="mb-3"><i class="fa-solid fa-user-tie me-2"></i> {{ Auth::user()->name }}</h4>
                            <h4 class="mb-3"><i class="fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }}</h4>
                            <h4 class="mb-3"><i class="fa-solid fa-mobile me-2"></i> {{ Auth::user()->phone }}</h4>
                            <h4 class="mb-3"><i class="fa-solid fa-mars-and-venus"></i> {{ Auth::user()->gender }}</h4>
                            <h4 class="mb-3"><i class="fa-solid fa-location-dot me-2"></i>  {{ Auth::user()->address }}</h4>
                            <h4 class="mb-3"><i class="fa-solid fa-calendar-check me-2"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                       </div>
                    </div>

                    <a href="{{ route('admin#editPage') }}" class="float-end ">
                        <button class="btn btn-sm bg-dark text-white px-4 mt-2">Edit <i class="fa-solid fa-pen ms-1"></i></button>
                    </a>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection