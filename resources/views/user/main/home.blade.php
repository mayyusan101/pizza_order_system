@extends('user.layouts.master')

@section('title','OneStop Online Sop')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <div class="custom-control bg-dark navbar-dark custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <label class="text-light mt-2 " for="price-all">Categories</label>
                        <div class="badge text-bg-secondary me-3">{{ count($categories) }}</div>
                    </div>
                    <a href="{{ route('user#home') }}" class="d-block text-dark"> <label class="" for="price-1">All</label></a>
                    <form>
                        @csrf

                        @foreach ($categories as $c)
                            <a href="{{ route('user#filter',$c->id) }}" class="d-block text-dark text-decoration-none cursor-pointer"> <p class="text-dark">{{ $c->name }}</p></a>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->
    
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartPage') }}">
                                    <button class="btn btn-sm btn-light position-relative"><i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cartList) }}</span>
                                     </button>
                                </a>
                                <a href="{{ route('user#historyPage') }}" class="ms-2 text-decoration-none"> <button class="btn btn-sm btn-light ml-2 position-relative"><i class="fa fa-bars"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($orders) }}</span></button> <span class="text-dark ms-2">History</span>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="" id="sortingOption" class="form-control ">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascendion</option>
                                        <option value="desc">Descendion</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="row" id="productContainer">
                        @if(count($products) != 0)
                            @foreach($products as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('User@addToCart',$p->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#detailPage',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href=""><h5 class="text-primary">{{ $p->name }}</h5></a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }} kyats</h5><h6 class="text-muted ml-2"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @elseif(count($products) == 0)
                            <span class="shadow-sm py-2 col-5 offset-4 fs-2 text-center">
                                    There is no product <i class="fa-regular fa-face-frown ms-2"></i>
                            </span>
                        @endif
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->   
        </div>
    </div>
@endsection

@section('scriptContent')
<script>
$(document).ready(function(){
       
    $('#sortingOption').change(function(){
            
        $status = $('#sortingOption').val();
        if($status == 'asc'){
            $.ajax({
                type : 'get',
                url : '/user/ajax/product/list',   //api
                data : {'status' : 'asc'},
                dataType : 'json',
                success : function(response){
                        
                    $list = '';
                    for (let $i = 0; $i < response.length; $i++) {
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` ; 
                    }
                    $('#productContainer').html($list);            
                }
            })
        }else if($status == 'desc'){
            $.ajax({
                type : 'get',
                    url : '/user/ajax/product/list',
                    data : {'status' : 'desc'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for (let $i = 0; $i < response.length; $i++) {
                            $list += `
                             <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ` ; 
                        }
                        $('#productContainer').html($list);                
                    }
                })
        }
    
    })

    $('#titleHome').addClass("active");
})
</script>
@endsection