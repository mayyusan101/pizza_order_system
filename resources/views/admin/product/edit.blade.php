@extends('admin.layouts.master')

@section('title','Edit Product')

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
                            <h3 class="text-center title-2">Update Your Product</h3>
                        </div>
                        <hr>
                        <form action="{{route('Product@update',$pizza->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" alt="">
                                    
                                    <div class="form-group mt-2">
                                        <label for="cc-payment" class="control-label mb-1">Choose image</label>
                                        <input id="cc-pament" name="pizzaImage" type="file" value="" class="form-control  @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your image..">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="price" type="text" value="{{ $pizza->view_count }}" disabled class="form-control  @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price..">
                                    </div>
                                    
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control  @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product name..">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach($categories as $c)
                                                <option value="{{ $c->id }}" @if( $c->id == $pizza->category_id) selected @endif> {{ $c->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id="cc-payment" cols="30" rows="4" placeholder="Enter description..">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Wating Time</label>
                                        <input id="cc-pament" name="waitingTime" type="number" value="{{ old('waitingTime',$pizza->waiting_time) }}" class="form-control  @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time..">
                                        @error('waitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" type="text" value="{{ old('price',$pizza->price) }}" class="form-control  @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price..">
                                        @error('price')
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