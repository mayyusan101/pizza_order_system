@extends('user.layouts.master')

@section('title','Product Detail')

@section('content')

    <!-- Shop Detail Start -->

    <div class="row ms-5 mb-3 "><a href="{{ route('user#home') }}" class="text-decoration-none" ><i class="fa-solid fa-arrow-left-long fs-5 me-1 text-dark d-inline" ></i><span class="text-dark mb-2 fs-5">back</span></a>
    </div>

    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$pizza->image) }}" alt="Image">
                        </div>
                    </div>
    
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{ $pizza->view_count }} <i class="fa-solid fa-eye"></i> views</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} kyats</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus text-white"></i>
                                </button>
                            </div>
                            <input type="text" id="count" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus text-white"></i>
                                </button>
                            </div>
                        </div>
                        <a href="#"><button class="btn btn-primary px-3" id="addToCart"><i class="fa fa-shopping-cart mr-1 text-dark"></i> 
                            <span class="text-white">Add To Cart</span>
                        </button></a>
                    </div>
                    {{-- hidden for user_id and pizza_id for cart --}}
                    <input type="hidden" value="{{ $pizza->id }}" id="productId">
                    <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f "></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzas as $item)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/'.$item->image) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#detailPage',$item->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $item->price }}</h5><h6 class="text-muted ml-2"></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
   
@endsection

@section('scriptContent')
<script>
    $(document).ready(function(){

        $('#addToCart').click(function(){
            $count = $('#count').val();
            $userId = $('#userId').val();
            $productId = $("#productId").val();
            $source = {
                'userId' : $userId,
                'productId' : $productId,
                'count' : $count,
            };
            $.ajax({
                type : 'get',
                url : '/user/ajax/product/addToCart',
                data : $source,
                dataType : 'json',
                success : function(response){
                    if(response.success){
                        window.location.href = '/user/homePage';
                    }
                }
            })   
        })
    })
</script>
@endsection