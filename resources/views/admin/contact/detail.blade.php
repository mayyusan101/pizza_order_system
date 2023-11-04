@extends('admin.layouts.master')

@section('title','Contact Detail')

@section('content')

<div class="main-content">
    <div class="row mb-1 me-1">
        <div class="col-6 offset-5 ">
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{ route('admin#contactPage') }}" class="text-decoration-none">
                <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark"></i></div>
            </a>
            <div class="card mx-5">
                <div class="card-body ">
                    <div class="card-title d-flex justify-content-between">
                        <h3 class="text-center title-2 fs-4">Name - <span class="text-warning">{{ $contact->name }}  </span></h3>
                        <div class="email"><i class="fa-regular fa-envelope-open me-2"></i> {{ $contact->email }}</div>
                        <div><i class="fa-solid fa-calendar-check text-primary opacity-75"></i>  <p class="d-inline ">{{ $contact->created_at->format('j-F-Y') }}</p></div>
                    </div>
                    <hr> 
                    <div class="row mb-2">
                        <div class="col-3 offset-1 ">
                            <i class="fa-solid fa-file-pen ms-3 text-danger opacity-75"></i><span class="d-inline">Message  -</span>
                        </div>
                        <div class="col-8 ">
                            <p class="block-email">
                                {{ $contact->message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection