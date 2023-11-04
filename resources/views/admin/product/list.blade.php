@extends('admin.layouts.master')

@section('title','Products List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-10px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between mb-4 align-items-center">   
                        <h4 class="text-secondary">Total - <span class="text-success">{{ $pizzas->total() }}</span></h4>
                        <h5 class="text-secondary">Search Key : <span class="text-primary">{{ request('searchKey') }}</span></h5>
                        <div >
                            <form action="{{ route('product#listPage') }}" method="get" class="d-flex">
                                <input type="text" name="searchKey" id="" class="form-control" value="{{ request('searchKey') }}" placeholder="search...">
                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(session('delete_message'))
                    <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                        <strong>  {{ session('name') }} {{ session('delete_message') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif

               @if ($pizzas->total() != 0)
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center ">
                    <thead >
                        <tr>
                            <th>Image</th>
                            <th class="col-4 offset-6"> Name</th>
                            <th>Category</th>
                            <th>view_count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $p)
                            <tr class="tr-shadow ">
                                <td>
                                    <img src="{{ asset('storage/'.$p->image) }}" class=" shadow-sm" alt="" class="img-thumbnail">
                                </td>
                                <td> <span class="block-email">{{ $p->name }}</span></td>
                                <td>{{ $p->category_name }}</td>
                                <td> <i class="fa-solid fa-eye"></i> {{ $p->view_count }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('product#viewPage',$p->id) }}" class="me-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-regular fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product#updatePage',$p->id) }}" class="me-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('Product@delete',$p->id) }}" class="me-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>    
                                    </div>
                                </td>
                            </tr>    
                            <tr class="spacer"></tr>
                        @endforeach
                   
                    </tbody>
                </table>
            </div> 
            @else
                <div class="d-flex justify-content-center mt-5">
                    <h2 class="text-secondary mt-3">There is no product </h2>
                </div> 
            @endif
                <!-- END DATA TABLE -->

                <div class="mt-2">
                   {{ $pizzas->appends(request()->query())->links() }}
                </div>
            </div>        
        </div>   
    </div>
</div>
@endsection
