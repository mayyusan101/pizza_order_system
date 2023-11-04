@extends('admin.layouts.master')

@section('title','Create Product')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8 " style="margin-top:-20px;">
                    <a href="{{ route('product#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Product</h3>
                        </div>
                        <hr>
                        <form action="{{ route('Product@create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName') }}" class="form-control  @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product name..">
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
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
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
                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id="cc-payment" cols="30" rows="4" placeholder="Enter description..">{{ old('pizzaDescription') }}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="pizzaImage" type="file" value="{{ old('pizzaImage') }}" class="form-control  @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Wating Time</label>
                                <input id="cc-pament" name="waitingTime" type="number" value="{{ old('waitingTime') }}" class="form-control  @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time..">
                                @error('waitingTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="text" value="{{ old('price') }}" class="form-control  @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price..">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                             
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount me-1">Create</span>
                                    <i class="fa-solid fa-circle-right"></i>
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