@extends('admin.layouts.master')

@section('title','Product Detail')

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
                        <a href="{{ route('product#listPage') }}">
                            <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark"></i></div>
                        </a>
                        <h3 class="text-center title-2 fs-4">Name - <span class="text-warning">{{ $pizza->name }} </span><span class="text-info"> ({{ $pizza->category_name}})</span></h3> 
                    </div>
                    <hr> 
                    <div class="row ">
                       <div class="col-6 offset-3 ">
                            <img src="{{ asset('storage/'.$pizza->image) }}" alt="" class="w-100">
                       </div>
                    </div>
                    <div class="row my-3">
                        <div class="d-flex justify-content-evenly">
                            <div ><i class="fa-solid fa-money-bill-1-wave text-success "></i> <h4 class="d-inline text-secondary">{{ $pizza->price }} </h4><h5 class="d-inline text-secondary">kyats</ ></div>
                            <div ><i class="fa-solid fa-clock text-primary "></i> <h4 class="d-inline text-secondary">{{ $pizza->waiting_time }} </h4><h5 class="d-inline text-secondary">mins</h5></div>
                            <div><i class="fa-solid fa-eye text-info "></i> {{ $pizza->view_count }}</div>
                            <div><i class="fa-solid fa-calendar-check text-primary opacity-75"></i>  <p class="d-inline ">{{ $pizza->created_at->format('j-F-Y') }}</p></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 offset-1 ">
                            <i class="fa-solid fa-file-pen ms-3 text-danger opacity-75"></i><span>detail  -</span>
                        </div>
                        <div class="col-7 ">{{ $pizza->description }}</div>
                    </div>

                    <a href="{{ route('product#updatePage',$pizza->id) }}" class="float-end ">
                        <button class="btn btn-sm bg-dark text-white px-4 mt-2">Update <i class="fa-solid fa-pen ms-1"></i></button>
                    </a>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection